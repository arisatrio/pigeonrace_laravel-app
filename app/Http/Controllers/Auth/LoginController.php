<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(is_numeric($request->input('username'))){
            $field = 'nohp';
        } elseif (filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } 
        $request->merge([$field => $request->input('username')]);
   
        if(auth()->attempt($request->only($field, 'password'))){
            if (auth()->user()->role_id == 1) {
                return redirect()->route('superadmin.dashboard');
            } else if (auth()->user()->role_id == 2) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email & Password are incorrect.');
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\City;

class ProfileController extends Controller
{

    public function editProfile($id)
    {
        $user = User::find($id);

        return view('user.profile-edit', compact('user'));
    }

    public function profileStore(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, 
            [
                'name'      => 'required',
                'email'   => 'required|unique:users,email,'.$user->id,
                'nohp'   => 'required|unique:users,nohp,'.$user->id
            ]
        );

        $data =$request->all();
        $user->update($data);

        return redirect()->back()->with('messages', 'Data Profile Akun telah diperbaharui');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        
        $this->validate($request, 
            [
                'current_password'          => 'required',
                'password'                  => 'required|min:6|confirmed',
                'password_confirmation'     => 'required|min:6',
            ]
        );

        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password'  => Hash::make($request->password)
            ]);
            return redirect()->back()->with('messages', 'Password berhasil diperbaharui!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Password tidak cocok!']);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $city = City::pluck('name');

        return view('user.koordinat', compact('user', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'city'      => 'required',
                'latitude'   => 'required',
                'longitude'   => 'required',
            ]
        );

        $data = $request->all();        
        $user = User::find($id);
        $user->update([
            'city'  => $request->city,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('messages', 'Data Koordinat berhasil diperbaharui');
    }
}

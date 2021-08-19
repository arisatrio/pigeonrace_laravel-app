<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return view('super-admin.user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.user-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'role_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]
        );

        $data = $request->all();
        User::create($data);

        return redirect()->route('superadmin.user.index')->with('messages', 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('super-admin.user-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'role_id' => 'required'
            ]
        );
        if( $request->password != null){
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
        }else{
            $data = $request->except('password','password_confirmation');
        }
        $user->update($data);

        return redirect()->route('superadmin.user.index')->with('message', 'User Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('superadmin.user.index')->with('message', 'User Berhasiil Dihapus');
    }

    public function distance(Request $request)
    {
        if (($request->input('lat1') == $request->input('lat2')) && ($request->input('long1') == $request->input('long2') )) {
            return 0;
          }
          else {
            $theta = $request->input('long1') - $request->input('long2');
            $dist = sin(deg2rad($request->input('lat1'))) * sin(deg2rad($request->input('lat2'))) +  cos(deg2rad($request->input('lat1'))) * cos(deg2rad($request->input('lat2'))) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $km = $miles * 1.609344;
            // $unit = strtoupper($unit);
            return 
            "Lat awal : " . $request->input('lat1')."<br>".
            "Long awal : " . $request->input('long1'). "<br>".
            "<br>".
            "Lat akhir : ".$request->input('lat2')."<br>".
            "Long akhir : ".$request->input('long2')."<br>".
            "<br>".
            "Jarak : ".number_format($km, 3). " KM";
          }
    }
}

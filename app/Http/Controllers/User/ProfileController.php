<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

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

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, 
            [
                'password'      => 'required',
                'new_password'   => 'required',
                'nohp'   => 'required'
            ]
        );
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

        $userIp = request()->ip();
        $position = Location::get($userIp);
        if($position != false) {
            $liveLoc = [$position->latitude, $position->longitude];
        } else {
            $liveLoc = [-7.250445, 112.768845]; //if get loc by ip false set default to surabaya lat long
        }

        return view('user.koordinat', compact('user', 'city', 'liveLoc'));
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
                'user_id'   => 'required'
            ]
        );

        $data = $request->all();
        $user = User::find($id);
        $user->update($data);

        

        return redirect()->back()->with('messages', 'Data Koordinat berhasil diperbaharui');
    }
}

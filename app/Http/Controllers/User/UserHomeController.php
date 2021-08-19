<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Race;

class UserHomeController extends Controller
{
    public function index()
    {
        $race = Race::where('status', 'AKTIF')->get();

        $user = auth()->user();
        $isUserJoin = $user->join()->whereHas('join', function ($query) use($user) {
            $query->where('user_id', $user->id);
            $query->where('users_join_races.status', 1);
        })->exists();

        $r = $user->join()->whereHas('join', function ($query) use($user) {
            $query->where('user_id', $user->id);
            $query->where('users_join_races.status', 1);
        })->first();

        return view('user.home', compact('race', 'isUserJoin', 'r'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Player;
use App\User;
use Gate;

class PlayerController extends Controller
{
    public function __contstruct() {
        $this->middleware('auth');
    }

    public function stats(){
        if(Gate::denies('isRegistered', User::class)){
			return back();  
        }

        $player = Player::where('user_id', auth()->user()->id)->first();

        $stats = $player->stats()->with('match')->orderByDesc('time')->get();

        return view('Registered.myStats', compact('stats'));
    }
}

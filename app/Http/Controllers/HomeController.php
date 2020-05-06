<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Match;
use App\Stat;
use Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     
    public function index()
    {
        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $matchs = Match::where('date', '>=', $date)->orderByDesc('date')->take(5)->get();

        return view('home', compact('matchs', 'date'));
    }
}

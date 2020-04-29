<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use App\League;
use App\Match;
use Gate;
use Carbon;

class TeamAdminController extends Controller
{
    public function __construct()
	{
        $this->middleware('auth');
    }

    // Affihe la team de l'admin d'équipe
    public function myTeam(){
        if(Gate::denies('isTeamAdmin', User::class)){
			return back();  
        }
        
        $team = Team::where('admin_id', auth()->user()->id)->first();
        $league = League::where('id', $team->league_id)->first();
        $matchs_local = Match::where('local_team', $team->name)->orderByDesc('date')->get();
        $matchs_visitor = Match::where('visitor_team', $team->name)->orderByDesc('date')->get();
        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');

        if($team != null){
            $players = $team->players()->get();

            return view('TeamAdmin.index', compact('team', 'league', 'players', 'matchs_local', 'matchs_visitor', 'date'));
        }

        return view('TeamAdmin.index', compact('team', 'league'));
    }

    // Change le nom de l'équipe
    public function changeName(Request $request){
        if(Gate::denies('isTeamAdmin', User::class)){
			return back();  
        }

        // Valider
        $this->validate(request(), [
            'TeamName' => 'required'
        ]);
        
        // Enregistrer
        $team = Team::find($request->input('team_id'));
        $oldName = $team->name;
        $team->update(['name' => $request->input('TeamName')]);

        //Changer les matchs qui sont lié à l'équipe
        $matchs = Match::get();
        foreach($matchs as $match){
            if($match->local_team == $oldName){
                $match->update(['local_team' => $team->name]);
            }

            if($match->visitor_team == $oldName){
                $match->update(['visitor_team' => $team->name]);
            }
        }

        // Rediriger
		return back();
    }
}

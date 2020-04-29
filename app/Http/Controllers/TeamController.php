<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Player;
use App\League;
use App\User;
use Gate;

class TeamController extends Controller
{
    public function __construct()
	{
        $this->middleware('auth');
    }
    
    // Affiche toutes les équipe de la personne
    public function myTeams(){
        if(Gate::denies('isRegistered', User::class)){
			return back();  
        }

        $player = Player::where('user_id', auth()->user()->id)->first();
        $teams = $player->teams()->get();
        

        return view('Registered.myTeam', compact('teams'));
    }

    // Affiche les renseignements d'une team
    public function showTeam(Team $team){
        // Pour afficher tous les joueurs de l'équipe
        $players = $team->players()->get();
        // Afficher la ligue et les matchs de l'équipe
        $league = League::where('id', $team->league_id)->first();
        //$matchs_local = Match::where('local_team', $team->name)->orderByDesc('date')->get();                 /* Afficher les matchs qui sont en tre aujourdhui et le future
        //$matchs_visiteur = Match::where('visitor_team', $team->name)->orderByDesc('date')->get();

        if($team != null){
            $players = $team->players()->get();

            return view('Team.showTeam', compact('team', 'league', 'players'));
        }

        return view('Team.showTeam', compact('team', 'players'));
    }

    // Supprime un joueur
    public function destroyPlayer(Player $player){
        $player->delete();

        return back();
    }






    public function stats(){
        $player = auth()->user()->player()->get();
        $stats = $player->stats()->get();

        return view('Registered.myStats', compact('stats'));
    }
}

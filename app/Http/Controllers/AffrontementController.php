<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\Team;
use App\Match;
use App\Player;
use Gate;
use Carbon;
use DB;
use Session;
use Illuminate\Http\Request;

class AffrontementController extends BaseController
{
    public function index(Match $match)
    {
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $match_date = Carbon\Carbon::parse($match->date);
        $isToday = $match_date->isToday();
        // Récupérer les joueur des équipes
        $localPlayers = Team::where('name', $match->local_team)->with('players')->first();
        $visitorPlayers = Team::where('name', $match->visitor_team)->with('players')->first();

        // Retourner la page pour administrer
        return view('Affrontement.index', compact('match', 'isToday', 'localPlayers', 'visitorPlayers', 'date'));
    }






    // Ajouter un but équipe locale
    public function scoreLocal(Match $match){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $data = array('final_score_local'=>$match->final_score_local + 1);
        DB::table('matchs')->where('id', $match->id)->update($data);
    }

    // Ajouter un but équipe visiteur
    public function scoreVisitor(Match $match){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $data = array('final_score_visitor'=>$match->final_score_visitor + 1);
        DB::table('matchs')->where('id', $match->id)->update($data);
    }




    // AJouter un lancer équipe local
    public function lancerLocal(Match $match){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $data = array('local_shots'=>$match->local_shots + 1);
        DB::table('matchs')->where('id', $match->id)->update($data);
    }

    // AJouter un lancer équipe Visitor
    public function lancerVisitor(Match $match){
        if(Gate::denies('isAdmin', User::class)){
            return back();  
        }

        $data = array('visitor_shots'=>$match->visitor_shots + 1);
        DB::table('matchs')->where('id', $match->id)->update($data);
    }








    // Ajouter une stat local
    public function statLocal(Request $request){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $time = Carbon\Carbon::now();

        $data = array('name'=>$request->input('name'), 'match_id'=>$request->input('match_id'), 'player_id'=>$request->input('player_id'), 'time'=>$time, 'period'=>$request->input('period'));
        DB::table('stats')->insert($data);
        
    }

    // Ajouter une stat visiteur
    public function statVisitor(Request $request){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $time = Carbon\Carbon::now();

        $data = array('name'=>$request->input('name'), 'match_id'=>$request->input('match_id'), 'player_id'=>$request->input('player_id'), 'time'=>$time, 'period'=>$request->input('period'));
        DB::table('stats')->insert($data);
        
    }




    // Finir le match
    public function endMatch(Match $match){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }
        
        if($match->final_score_local > $match->final_score_visitor){
            $winning_team = $match->local_team;
            $losing_team = $match->visitor_team;
        }elseif($match->final_score_visitor > $match->final_score_local){
            $winning_team = $match->visitor_team;
            $losing_team = $match->local_team;
        }else{
            $winning_team = "match nul";
            $losing_team = "match nul";
        }

        $data = array(
            'winning_team'=>$winning_team, 
            'losing_team'=>$losing_team
        );
        DB::table('matchs')->where('id', $match->id)->update($data);
    }
}

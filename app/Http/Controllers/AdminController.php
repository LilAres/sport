<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
use Carbon;
use App\Role;
use App\User;
use App\Team;
use App\League;
use App\Match;
use App\Season;
use App\Player;

class AdminController extends Controller
{
    public function __construct()
	{
        $this->middleware('auth');
    }

    // ***** Les teams *****

    // Affiche toutes les teams
    public function teams(){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $teams = Team::get();
        // Pour la liste déroulante
        $leagues = League::get();
        $team_admin = Role::where('name', 'team_admin')->first()->users()->get();

        return view('Team.index', compact('teams', 'leagues', 'team_admin'));
    }

    // Supprime une team
    public function destroyTeam(Team $team){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $team->players()->delete();
        $team->delete();
		
		return redirect('/manageTeams');
    }

    // Ajoute une équipe
    public function storeTeam(Request $request){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        // Valider
        $this->validate(request(), [
			'name' => 'required',
            'league' => 'required',
            'admin' => 'required'
		]);
        
        // Enregistrer
        $name = $request->input('name');
        $league_id = $request->input('league');
        $admin_id = $request->input('admin');

        // Si le nom d'équipe est déja pris
        if(Team::where('name', $name)->first()){
            return back()->withErrors(["L'équipe existe déjà!"]);
        }

        $data = array('name'=>$name, 'admin_id'=>$admin_id, 'league_id'=>$league_id);
        DB::table('teams')->insert($data);

		// Rediriger
		return back();
    }







    // ***** Les leagues *****

    // Affiche toutes les leagues
    public function leagues(){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $leagues = League::get();

        return view('League.index', compact('leagues'));
    }

    // Supprime une league
    public function destroyLeague(League $league){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        // Supprimer la ligue
        $league->delete();
		
		return back();
    }

    // Ajoute une league
    public function storeLeague(Request $request){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }
        
        // Valider
        $this->validate(request(), [
			'name' => 'required',
			'category' => 'required'
		]);

        // Enregistrer
        $name = $request->input('name');
        $category = $request->input('category');

        $data = array('name'=>$name, 'category'=>$category);
        DB::table('leagues')->insert($data);

		// Rediriger
		return back();
    }







    // ****** Les saisons ******

    // Affiche toutes les saisons
    public function seasons(){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }
        
        $seasons = Season::with('league')->get();
        // Pour la liste déroulante
        $leagues = League::get();

        return view('Season.index', compact('seasons', 'leagues'));
    }

    // Supprime une saison
    public function destroySeason(Season $season){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $season->matchs()->delete();
        $season->delete();
		
		return back();
    }

    // Ajoute une saison
    public function storeSeason(Request $request){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        // Valider
        $this->validate(request(), [
            'name' => 'required',
            'league' => 'required',
            'end_date' => 'required',
            'start_date' => 'required'
		]);

        // Enregistrer
        $name = $request->input('name');
        $league_id = $request->input('league');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');


        $data = array('name'=>$name, 'league_id'=>$league_id, 'start_date'=>$start_date, 'end_date'=>$end_date);
        DB::table('seasons')->insert($data);

		// Rediriger
		return back();
    }







    // ****** Les joueurs ******

    // Supprime un joueur
    public function destroyPlayer(Player $player){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $player->delete();
		
		return back();
    }

    // Ajoute un joueur
    public function storePlayer(Request $request){
        if(Gate::denies('create', Player::class)){
			return back();  
        }
        
        // Valider
        $this->validate(request(), [
            'name' => 'required'
		]);

        // Enregistrer
        // Créer le joueur
        $playerCreated = $this->createPlayer($request);
        // Le récupérer
        $player = Player::where('name', $playerCreated['name'])->first();
        // Créer le champ dans la table Player_Team
        $data = array('player_id'=>$player->id, 'team_id'=>$request->input('team_id'));
        DB::table('player_team')->insert($data);
        
		// Rediriger
		return back();
    }

    // Crée un joueur
    public function createPlayer(Request $request){
        if(Gate::denies('create', Player::class)){
			return back();  
        }

        $user = User::select('id')->where('name', $request->input('name'))->first();
            
        if($user != null){
            $name = $request->input('name');
            $user_id = $user->id;
    
            $data = array('name'=>$name, 'user_id'=>$user_id);
            DB::table('players')->insert($data);
        
            return $data;
        }else{
            $name = $request->input('name');

            $data = array('name'=>$name);
            DB::table('players')->insert($data);
    
            return $data;
        }
    }







    
    // ****** Les matchs ******

    // Affiche tous les matchs
    public function matchs(){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }
        
        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $seasons = Season::get();
        $matchs = Match::orderBy('date')->get();

        $equipes = Team::with('players', 'league')->get();

        // S'il y au moins une équipe qui à des joueurs
        $noTeams = true;
        foreach($equipes as $equipe){
            if($equipe->players->count() > 0){
                $noTeams = false;
            }
        }

        return view('Match.index', compact('matchs', 'equipes', 'seasons', 'date', 'noTeams'));
    }

    // Supprime un match
    public function destroyMatch(Match $match){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        $match->delete();
		
		return back();
    }

    // Ajoute un match
    public function storeMatch(Request $request){
        if(Gate::denies('isAdmin', User::class)){
			return back();  
        }

        // Valider
        $this->validate(request(), [
            'local_team' => 'required',
            'visitor_team' => 'required',
            'date' => 'required',
            'localisation' => 'required',
            'season' => 'required'
        ]);
        
        // Enregistrer
        $local_team = Team::with('league')->find($request->input('local_team'));
        $visitor_team = Team::with('league')->find($request->input('visitor_team'));
        $date = Carbon\Carbon::parse($request->input('date'));

        // Si la date est plus petite ou égale qu'aujourdhui
        $mytime = Carbon\Carbon::now()->format('Y/m/d');
        if($mytime >= $date->format('Y/m/d')){
            return back()->withErrors(['La date doit être dans le futur!']);
        }

        // Si l'équipe locale est égal à l'équipe visiteur rediriger avec erreur
        if($request->input('local_team') == $request->input('visitor_team')){
            return back()->withErrors(['Les deux équipes ne peuvent pas être les mêmes!']);
        }

        // Si les deux équipes ne sont pas de la même league
        if($local_team->league != $visitor_team->league){
            return back()->withErrors(['Veuillez choisir deux équipes qui sont dans la même ligue!']);
        }

        $localisation = $request->input('localisation');
        $season = $request->input('season');
        $winning_team = "";
        $losing_team = "";
        $final_score_local = 0;
        $final_score_visitor = 0;
        $local_shots = 0;
        $visitor_shots = 0;

        $data = array('local_team'=>$local_team->name, 'visitor_team'=>$visitor_team->name, 'date'=>$date, 'localisation'=>$localisation, 
        'season_id'=>$season, 'winning_team'=>$winning_team, 'losing_team'=>$losing_team, 'final_score_local'=>$final_score_local,
         'final_score_visitor'=>$final_score_visitor, 'local_shots'=>$local_shots, 'visitor_shots'=>$visitor_shots);
        DB::table('matchs')->insert($data);

		// Rediriger
		return back();
    }
}

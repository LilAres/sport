@extends('layouts.master')


@section('content')
    <div>
        @if(Auth::user()->Admin() || Auth::user()->Team_Admin())
            <div>
                <h3>Ajouter un joueur à l'équipe</h3>
                
                <form method="POST" action="/managePlayer/store">
                    {{ csrf_field() }}
                    
                    <input type="hidden" value="{{$team->id}}" name="team_id">

                    <div class="form-group">
                        <label for="title">Nom :</label>
                        <input class="form-control" id="SeasonName" placeholder="Nom du joueur" name="name" >
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>

                    @include('layouts.errors')
                </form>
            </div>
        @endif
        
        <div>
            <h1>{{ $team->name }}</h1>

            <h5>Ligue {{ $league->name }} - {{ $league->category }}</h5>

            @if(Auth::user()->Admin() || Auth::user()->Team_Admin())
                <form method="POST" action="/manageTeams/{{ $team->id }}/delete">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Supprimer l'équipe</button>
                    </div>
                </form>
            @endif
        </div>
        
            <div>
                <hr>

                <h3>Liste des joueurs ({{$players->count() }})</h3>

                    @if($players->count() == 0)
            
                        <p>Aucun joueur dans l'équipe</p>
            
                    @endif
            
                    @if($players->count() > 0)
                        <ul>
                            @foreach($players as $player)
            
                                <li>
                                    {{ $player->name }}

                                    @if(Auth::user()->Admin() || Auth::user()->Team_Admin())
                                        <form method="POST" action="/managePlayer/{{ $player->id }}/delete">
                                            {{ csrf_field() }}
                                
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer le joueur</button>
                                            </div>
                                        </form>                            
                                    @endif
                                </li>
            
                            @endforeach
                        </ul>
                    @endif
            </div>
    </div>
@endsection
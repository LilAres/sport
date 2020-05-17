@extends('layouts.master')


@section('content')

<div>


    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Gérer votre équipe</h1>
        </div>
    </div>

    <h3>Votre équipe</h3>
    @if($team == null)

        <p>Vous ne dirigez pas d'équipe.</p>

    @endif

    @if($team != null)

        <h6>Voici les information de l'équipe que vous dirigez :</h6> 
        <form method="POST" action="/manageTeam/changeName">
            {{ csrf_field() }}

            <input type="hidden" value="{{$team->id}}" name="team_id">

            <div class="form-group">
                <input class="form-control" value="{{ $team->name }}" name="TeamName" >
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Enregistrer</button>
            </div>

            @include('layouts.errors')
        </form>

        <h5>Ligue {{ $league->name }} - {{ $league->category }}</h5>

        <hr>

        <div>
            <h3>Ajouter un joueur à l'équipe</h3>
            
            <form method="POST" action="/managePlayer/store">
                {{ csrf_field() }}

                <input type="hidden" value="{{$team->id}}" name="team_id">

                <div class="form-group">
                    <label for="title">Nom :</label>
                    <input class="form-control" placeholder="Nom du joueur" name="name" >
                </div>
    
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
    
                @include('layouts.errors')
            </form>
        </div>

        <hr>

        <div class="row">
            <div class="col-6">
                <h3>Liste des joueurs ({{$players->count() }})</h3>

                @if($players->count() == 0)
        
                    <p>Aucun joueur dans l'équipe</p>
        
                @endif
        
                @if($players->count() > 0)
                    <ul>
                        @foreach($players as $player)
        
                            <li>
                                {{ $player->name }}
                                <form method="POST" action="/managePlayer/{{ $player->id }}/delete">
                                    {{ csrf_field() }}
                        
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer le joueur</button>
                                    </div>
                                </form>
                            </li>
        
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="col-6">
                <h3>Liste des matchs locaux</h3>
                @if($matchs_local->count() == 0)

                    <p>Aucun match local</p>

                @endif

                @if($matchs_local->count() > 0)
                    @foreach($matchs_local as $match)

                        @include('Match.match')

                    @endforeach
                @endif

                <hr>

                <h3>Liste des matchs visiteurs</h3>
                @if($matchs_visitor->count() == 0)

                    <p>Aucun match visiteur</p>

                @endif

                @if($matchs_visitor->count() > 0)
                    @foreach($matchs_visitor as $match)

                        @include('Match.match')

                    @endforeach
                @endif
            </div>
        </div>
        
    @endif
    

</div>
@endsection
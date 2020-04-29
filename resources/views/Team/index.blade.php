@extends('layouts.master')


@section('content')

<div>
    <div>
        <h3>Ajouter une équipe</h3>
        
        <form method="POST" action="/manageTeams/store">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="title">Nom :</label>
                <input class="form-control" id="TeamName" placeholder="Nom de l'équipe" name="name" >
            </div>

            <div class="form-group">
                <label for="title">Ligue :</label>
                <select name="league" class="form-control">
                    <option value="">Sélectionner une ligue</option>
                        @foreach ($leagues as $league)
                            <option value="{{ $league->id }}">{{ $league->name }}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Admin de la team :</label>
                <select name="admin" class="form-control">
                    <option value="">Sélectionner un admin</option>
                        @foreach ($team_admin as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>

    <hr>
    
    <h3>Liste de toutes les équipes</h3> 

    @if($teams->count() == 0)

        <p>Aucune équipe</p>

    @endif

    @if($teams->count() > 0)
        @foreach($teams as $team)

            <hr>

            <h1><a href="/team/{{$team->id}}">{{ $team->name }}</a></h1>

        @endforeach
    @endif
</div>
@endsection
@extends('layouts.master')


@section('content')

<div>
    <div>
        <h3>Ajouter une ligue</h3>
        
        <form method="POST" action="/manageLeagues/store">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="title">Nom :</label>
                <input class="form-control" id="LeagueName" placeholder="Nom de la ligue" name="name" >
            </div>

            <div class="form-group">
                <label for="title">Catégorie :</label>
                <input class="form-control" id="LeagueCategorie" placeholder="Catégorie" name="category" >
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success">Ajouter</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>

    <hr>

    <h3>Liste de toutes les ligues</h3>

    @if($leagues->count() == 0)

        <p>Aucune ligue</p>

    @endif

    @if($leagues->count() > 0)
        @foreach($leagues as $league)

            <hr>
            
            <p>{{ $league->name }} - {{$league->category }}</p>

            <form method="POST" action="/manageLeagues/{{ $league->id }}/delete">
                {{ csrf_field() }}
    
                <div class="form-group">
                <button type="submit" class="btn btn-danger">Supprimer la ligue</button>
                </div>
            </form>

        @endforeach
    @endif
</div>  
@endsection
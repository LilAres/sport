@extends('layouts.master')


@section('content')

<div>
    <h3>Liste de toutes vos équipes</h3> 

    @if($teams->count() == 0)

        <p>Vous êtes dans aucune équipe</p>

    @endif

    @if($teams->count() > 0)
        @foreach($teams as $team)

            <hr>

            <h1><a href="/team/{{$team->id}}">{{ $team->name }}</a></h1>

        @endforeach
    @endif
</div>
@endsection
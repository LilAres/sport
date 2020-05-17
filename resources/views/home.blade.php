@extends('layouts.master')


@section('content')
    <div>

        
        <div class="blog-header">
            <div class="container">
                <h1 class="blog-title">Accueil</h1>
            </div>
        </div>


        <h3>Matchs à venir</h3>

        @if($matchs->count() == 0)

            <p>Aucun match à venir</p>

        @endif

        @if($matchs->count() > 0)
            @foreach($matchs as $match)

                @include('Match.match')

            @endforeach
        @endif
    </div>
@endsection
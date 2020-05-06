@extends('layouts.master')


@section('content')
    <div>
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
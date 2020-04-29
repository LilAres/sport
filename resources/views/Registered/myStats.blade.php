@extends('layouts.master')


@section('content')

    <div>

        <h2>Listes de vos statistiques</h2>

        @foreach($stats as $stat)

            <hr>

            <!-- Vérifier si c'est l'équipe local qui est gagante -->
            @if($stat->match->winning_team == $stat->match->local_team)
                <h6>{{ $stat->name }} effectué durant la période {{ $stat->period }}</h6>
                <p>{{ $stat->match->local_team }} ({{ $stat->match->final_score_local }} point(s)) VS {{ $stat->match->visitor_team }} ({{ $stat->match->final_score_visitor }} point(s))</p>
            @endif

            <!-- Vérifier si c'est l'équipe visiteur qui est gagante -->
            @if($stat->match->winning_team == $stat->match->visitor_team)
                <h6>{{ $stat->name }} effectué durant la période {{ $stat->period }}</h6>
                <p>{{ $stat->match->visitor_team }} ({{ $stat->match->final_score_visitor }} point(s)) VS {{ $stat->match->local_team }} ({{ $stat->match->final_score_local }} point(s))</p>
            @endif
        @endforeach

    </div>
   
@endsection
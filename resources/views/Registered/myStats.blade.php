@extends('layouts.master')


@section('content')

    <div>
        <h3>Liste de vos statistiques</h3>

        @if($stats->count() == 0)
            <p>Vous n'avez pas encore de statistique.</p>
        @endif

        @if($stats->count() > 0)
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
        @endif

    </div>
   
@endsection
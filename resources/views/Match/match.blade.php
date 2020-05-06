<hr>

<!-- Si le match n'est pas encore passé -->
@if($match->winning_team == null)
    @if(\Carbon\Carbon::parse($match->date)->format('d/m/Y') > \Carbon\Carbon::parse($date)->format('d/m/Y'))
        <h5><mark>Match à venir</mark></h5>
    @endif

    @if(\Carbon\Carbon::parse($match->date)->format('d/m/Y') == \Carbon\Carbon::parse($date)->format('d/m/Y'))
        <h5><mark>** Match aujourd'hui **</mark></h5>
    @endif

    @if(\Carbon\Carbon::parse($match->date)->format('d/m/Y') < \Carbon\Carbon::parse($date)->format('d/m/Y'))
        <h5><mark>Match passé, mais non conplété</mark></h5>
    @endif


    <h5>{{ $match->local_team }} (local) VS {{$match->visitor_team }} (visiteur)</h5>

    <p>
        Lieux : {{ $match->localisation }}<br>
        Date : {{ date('d/M/Y', strtotime($match->date)) }}
    </p>    

    @if(Auth::user()->Admin())
        <form method="POST" action="/manageMatchs/{{ $match->id }}/delete">
            {{ csrf_field() }}
            @if(\Carbon\Carbon::parse($match->date)->format('d/m/Y') >= \Carbon\Carbon::parse($date)->format('d/m/Y'))
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Supprimer le match</button>
                </div>
            @endif
            
        </form>

        <form method="GET" action="/affrontement/{{ $match->id }}">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Administrer le match</button>
            </div>
        </form>
    @endif
@endif

<!-- Si le match est passé -->
@if($match->winning_team != null)
    <h5>Équipe gagnante : {{ $match->winning_team }}</h5>
    <h5>{{ $match->local_team }} ({{ $match->final_score_local }} point(s)) VS {{$match->visitor_team }} ({{ $match->final_score_visitor }} point(s))</h5>
        
    <p>
        Lieux : {{ $match->localisation }}<br>
        Date : {{ date('d/M/Y', strtotime($match->date)) }}
    </p>  
@endif


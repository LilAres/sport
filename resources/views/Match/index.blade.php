@extends('layouts.master')


@section('content')

<div>
    <div>
        <h3>Ajouter un match</h3>
        
        @if(!$noTeams)
            <form method="POST" action="/manageMatchs/store">
                {{ csrf_field() }}

                @include('layouts.errors')
                
                <div class="form-group">
                    <label for="title">Équipe locale :</label>
                    <select name="local_team" class="form-control">
                        <option value="">Sélectionner une équipe</option>
                            @foreach ($equipes as $equipe)
                                @if($equipe->players->count() > 0)
                                    <option value="{{ $equipe->id }}">{{ $equipe->name }} - {{ $equipe->league->name }} {{ $equipe->league->category }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Équipe viteur :</label>
                    <select name="visitor_team" class="form-control">
                        <option value="">Sélectionner une équipe</option>
                            @foreach ($equipes as $equipe)
                                @if($equipe->players->count() > 0)
                                    <option value="{{ $equipe->id }}">{{ $equipe->name }} - {{ $equipe->league->name }} {{ $equipe->league->category }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>

                <div class="form-group"> 
                    <label class="control-label" for="date">Date du match :</label>
                    <input class="form-control date" name="date" placeholder="MM/DD/YYY" type="text"/>
                </div>

                <div class="form-group">
                    <label for="title">Lieux :</label>
                    <input class="form-control" placeholder="Lieux" name="localisation" >
                </div>

                <div class="form-group">
                    <label for="title">Saison :</label>
                    <select name="season" class="form-control">
                        <option value="">Sélectionner une saison</option>
                            @foreach ($seasons as $season)
                                <option value="{{ $season->id }}">{{ $season->name }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        @endif

        @if($noTeams)

            <p>Aucune équipe n'est disponible</p>

        @endif
    </div>

    <hr>

    <h3>Liste de tous les matchs</h3>

    @if($matchs->count() == 0)

        <p>Aucun match</p>

    @endif

    @if($matchs->count() > 0)
        @foreach($matchs as $match)

            @include('Match.match')

        @endforeach
    @endif

</div>  
<script>
    $(document).ready(function(){
      var date_input=$('.date'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy/mm/dd',
        container: container,
        autoclose: true
      };
      date_input.datepicker(options);
    })
</script>
@endsection
@extends('layouts.master')


@section('content')

<div>
    <div>


        <div class="blog-header">
            <div class="container">
                <h1 class="blog-title">Gérer les saisons</h1>
            </div>
        </div>


        <h3>Ajouter une saison</h3>
        
        <form method="POST" action="/manageSeasons/store">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="title">Nom :</label>
                <input class="form-control" id="SeasonName" placeholder="Nom de la saison" name="name" >
            </div>

            <div class="form-group">
                <label for="title">Ligue :</label>
                <select name="league" class="form-control">
                    <option value="">Sélectionner une ligue</option>
                        @foreach ($leagues as $league)
                            <option value="{{ $league->id }}">{{ $league->name . " - " . $league->category }}</option>
                        @endforeach
                </select>
            </div>

            <!-- Date de départ -->
            <div class="form-group"> 
                <label class="control-label" for="date">Date de début :</label>
                <input class="form-control date" name="start_date" placeholder="MM/DD/YYY" type="text"/>
            </div>
        
            <!-- Date de fin -->
            <div class="form-group"> 
                <label class="control-label" for="date">Date de fin :</label>
                <input class="form-control date" name="end_date" placeholder="MM/DD/YYY" type="text"/>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>

    <hr>

    <h3>Liste de toutes les saisons</h3>

    @if($seasons->count() == 0)

        <p>Aucune saison</p>

    @endif

    @if($seasons->count() > 0)
        @foreach($seasons as $season)

            <hr>

            Saison pour la ligue : {{ $season->league->name }} - {{ $season->league->category }}
            <h4>{{ $season->name }}</h4>
            <h5>Du {{ date('d M yy', strtotime($season->start_date)) }} au {{ date('d M yy', strtotime($season->end_date)) }}</h5>

            <form method="POST" action="/manageSeasons/{{ $season->id }}/delete">
                {{ csrf_field() }}
    
                <div class="form-group">
                <button type="submit" class="btn btn-danger">Supprimer la saison</button>
                </div>
            </form>

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
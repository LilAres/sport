<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>{{ $match->local_team }} VS {{ $match->visitor_team }}</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
   <!-- Custom styles for this template -->
    <link href="/css/sport.css" rel="stylesheet">

  </head>
  <body>
    <div id="mobilemenu">
      <a id="close"><img src="/close-menu.png" alt="Close Icon" /></a>
      <ul>
        @if(Auth::check())
        <li><a href="/" class="nav-link">Accueil</a></li>
        @endif
        
        @if(!Auth::check())
          <li><a href="/login" class="nav-link">Se connecter</a></li>
          <li><a href="/register" class="nav-link">S'inscrire</a></li>
        @endif

        @if(Auth::check())
          @if(Auth::user()->Admin())
            <li><a href="/manageTeams" class="nav-link">Gérer les équipes</a></li>
            <li><a href="/manageMatchs" class="nav-link">Gérer les matchs</a></li>
            <li><a href="/manageSeasons" class="nav-link">Gérer les saisons</a></li>
            <li><a href="/manageLeagues" class="nav-link">Gérer les ligues</a></li>
          @endif
          
          @if(Auth::user()->Registered())
          <li><a href="/myTeams" class="nav-link">Mes équipes</a></li>
          <li><a href="/myStats" class="nav-link">Mes statistiques</a></li>
          @endif

          @if(Auth::user()->Team_Admin())
          <li><a href="/manageTeam" class="nav-link">Mon équipe</a></li>
          @endif

          <li><a href="/logout" class="nav-link text-danger">Se déconnecter</a><li>
        @endif</div>
      </ul>
    </div>
  <div class="page-container" id="affrontement">
    @include('layouts.nav')

    <div class="container justify-content-center">

            <div class="row text-center">
                <div class="col-5">
                    <h4>Local</h4>
                </div>
                <div class="offset-2 col-5">
                    <h4>Visiteur</h4>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-5">
                    <h1>{{ $match->local_team }}</h1>
                </div>
                <div class="col-2">
                    <h1>VS</h1>
                </div>
                <div class="col-5">
                    <h1>{{ $match->visitor_team }}</h1>
                </div>
            </div>

            <hr>

            @if(!$isToday && \Carbon\Carbon::parse($match->date)->format('d/m/Y') > \Carbon\Carbon::parse($date)->format('d/m/Y'))

                @include('Affrontement.timerBeforeMatch')
                
            @endif

            @if($isToday || \Carbon\Carbon::parse($match->date)->format('d/m/Y') < \Carbon\Carbon::parse($date)->format('d/m/Y'))

                @include('Affrontement.infos')

            @endif

      </div>


  @include('layouts.footer')
  <div class="page-container">  
  </body>

</html>

<script type='text/javascript' src='/js/functions.js'></script>

<script>
    // Ajouter un but
    var score_local = {{ $match->final_score_local }};
    var score_visitor = {{ $match->final_score_visitor }};
    var lancer_local = {{ $match->local_shots }};
    var lancer_visitor = {{ $match->visitor_shots }};

    $(document).ready(function(){
      // Ajouter une statistique Local
        
        $(".statLocal").click(function(e){
            if($('.nameLocal').val() != "" && $('.localPlayer').val() != 'default'){
                $.ajax({
                   type: 'POST',
                   url: '/affrontement/statLocal',
                   data:{
                       _token: "{{ csrf_token() }}",
                       'period': $('#periode').text(),
                       'match_id': {{ $match->id }},
                       'name': $('.nameLocal').val(),
                       'player_id': $('.localPlayer').val()
                       },
                   success: function (data) {
                        $(".localPlayer").val('default');
                        $(".nameLocal").val("");
                        alert("Ajouté avec succès!")
                   }
                });
            }else{
                alert("Veuillez indiquer un nom et un joueur!")
            }
        });

      // Ajouter une statistique visiteur
        $(".statVisitor").click(function(e){
            if($('.nameVisitor').val() != "" && $('.visitorPlayer').val() != 'default'){
                $.ajax({
                    type: 'POST',
                    url: '/affrontement/statVisitor',
                    data:{
                        _token: "{{ csrf_token() }}",
                        'period': $('#periode').text(),
                        'match_id': {{ $match->id }},
                        'name': $('.nameVisitor').val(),
                        'player_id': $('.visitorPlayer').val()
                        },
                    success: function (data) {
                            $(".visitorPlayer").val('default');
                            $(".nameVisitor").val("");
                            alert("Ajouté avec succès!")
                    }
                });
            }else{
                alert("Veuillez indiquer un nom et un joueur!")
            }
        });

      // Ajouter un but Local
      $(".scoreLocal").click(function(e){
        $.ajax({
                   type: 'POST',
                   url: '/affrontement/{{$match->id}}/scoreLocal',
                   data:{_token: "{{ csrf_token() }}"},
                   success: function (data) {
                        var score = $(".score_local");
                        score_local ++;
                        score.html(score_local);
                   }
        });
      });
      // Ajouter un lancer Local
      $(".lancerLocal").click(function(e){
        $.ajax({
                   type: 'POST',
                   url: '/affrontement/{{$match->id}}/lancerLocal',
                   data:{_token: "{{ csrf_token() }}"},
                   success: function (data) {
                        var lancer = $(".lancer_local");
                        lancer_local ++;
                        lancer.html(lancer_local);
                   }
        });
      });

      // Ajouter un but Visitor
      $(".scoreVisitor").click(function(e){
        $.ajax({
                   type: 'POST',
                   url: '/affrontement/{{$match->id}}/scoreVisitor',
                   data:{_token: "{{ csrf_token() }}"},
                   success: function (data) {
                        var score = $(".score_visitor");
                        score_visitor ++;
                        score.html(score_visitor);
                   }
        });
      });
      // Ajouter un lancer visiteur
      $(".lancerVisitor").click(function(e){
        $.ajax({
                   type: 'POST',
                   url: '/affrontement/{{$match->id}}/lancerVisitor',
                   data:{_token: "{{ csrf_token() }}"},
                   success: function (data) {
                        var lancer = $(".lancer_visitor");
                        lancer_visitor ++;
                        lancer.html(lancer_visitor);
                   }
        });
      });
      
    });


    // Terminer le match par timer ou par bouton admin
    function endMatch(){
        document.getElementById("timer").remove();
        var element = document.getElementById("period");
        element.innerHTML = "<div><h5 class='text-danger'>Fin du match</h5></div>";
        setTimeout(function (){
            $.ajax({
            type: 'POST',
            url: '/affrontement/{{$match->id}}/endMatch',
            data:{_token: "{{ csrf_token() }}"},
            success: function (data) {
                window.location = "/manageMatchs";
            }
        });
        }, 5000); 
        
    }

    $(".endMatch").click(function(e){
        endMatch();
    });



    //Timer pour une période
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var x = 1;

        function changePeriode(){
            var periode = document.getElementById("periode");
            periode.innerHTML = x;
        }

        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if(x > 4){
                endMatch(); 
                return;
            }

            if (--timer < 0) {
                x ++;
                timer = duration;
                
                if(x <= 4){
                    changePeriode();
                }
            }
            }, 1000);
        }

        window.onload = function () {
            var fourfiveminutes = 60 * 45,
                display = document.querySelector('#timer');
            startTimer(fourfiveminutes, display);
    };  
</script>

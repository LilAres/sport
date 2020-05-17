<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Sport</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <!-- Custom styles for this template -->
    <link href="/css/sport.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Muli:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

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
    <div class="page-container">

      @include('layouts.nav')


      <div class="container">

        <div class="row">

          @yield('content')

        </div>

      </div>

      @include('layouts.footer')
    </div>
  </body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script type='text/javascript' src='/js/functions.js'></script>

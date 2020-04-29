
<header>
<div class="blog-masthead">
  <div class="container">
    <nav class="nav blog-nav">
      <a href="/" class="nav-link active">Home</a>
      
      @if(!Auth::check())
        <a href="/login" class="nav-link">Se connecter</a>
        <a href="/register" class="nav-link">S'inscrire</a>
      @endif

      @if(Auth::check())
        @if(Auth::user()->Admin())
          <a href="/manageTeams" class="nav-link">Gérer les équipes</a>
          <a href="/manageMatchs" class="nav-link">Gérer les matchs</a>
          <a href="/manageSeasons" class="nav-link">Gérer les saisons</a>
          <a href="/manageLeagues" class="nav-link">Gérer les ligues</a>
        @endif
        
        @if(Auth::user()->Registered())
          <a href="/myTeams" class="nav-link">Mes équipes</a>
          <a href="/myStats" class="nav-link">Mes statistiques</a>
        @endif

        @if(Auth::user()->Team_Admin())
          <a href="/manageTeam" class="nav-link">Mon équipe</a>
        @endif

        <a href="/logout" class="nav-link text-danger">Se déconnecter</a>
      @endif
    </nav>
  </div>
</div>
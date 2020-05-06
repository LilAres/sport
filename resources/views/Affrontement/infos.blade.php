

<!-- Le score -->
<div class="row text-center">
    <div class="col-5">
        <h3 class="score_local">{{ $match->final_score_local }}</h3>
        <button class="btn btn-light scoreLocal">BUT</button>
    </div>
    <div class="col-2">
        <h6>Période <span class="1" id="periode">1</span></h6>
        <h3 class="mt-3" id="period"><span id="timer"></span></h3>
    </div>
    <div class="col-5">
        <h3 class="score_visitor">{{ $match->final_score_visitor }}</h3>
        <button class="btn btn-light scoreVisitor">BUT</button>
    </div>
</div>

<hr>


<!-- Les lancers au but -->
<div class="row text-center">
    <div class="col-12">
        <h4>Lancers au but</h4>
    </div>
    
    <div class="offset-1 col-5">
        <h3 class="lancer_local">{{ $match->local_shots }}</h3>
        <button class="btn btn-light lancerLocal">Lancer</button>
    </div>
    <div class="col-5">
        <h3 class="lancer_visitor">{{ $match->visitor_shots }}</h3>
        <button class="btn btn-light lancerVisitor">Lancer</button>
    </div>
</div>

<hr>

<!-- Statistiques -->
<div class="row justify-content-center text-center">
    <div class="col-12">
        <h4>Statistiques</h4>
    </div>

    <div col="col-4">
        <div class="form-group" id="statLocalForm">
            <label for="title">Joueurs locals :</label>
            <select name="localPlayer" class="form-control localPlayer">
                <option value="default">Sélectionner un joueur</option>
                    @foreach ($localPlayers->players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
            </select>

            <div class="form-group">
                <label for="title">Nom :</label>
                <input class="form-control nameLocal" placeholder="Ex : but" name="nameLocal" >
            </div>

            <button class="btn btn-light statLocal">Ajouter</button>
        </div>
    </div>
    <div col="offset-4 col-4">
        <div class="form-group" id="statVisitorForm">
            <label for="title">Joueurs visiteurs :</label>
            <select name="visitorPlayer" class="form-control visitorPlayer">
                <option value="default">Sélectionner un joueur</option>
                @foreach ($visitorPlayers->players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="title">Nom :</label>
                <input class="form-control nameVisitor" placeholder="Ex : but" name="nameVisitor" >
            </div>

            <button class="btn btn-light statVisitor">Ajouter</button>
        </div>
    </div>
</div>

<hr>

<div class="row justify-content-center text-center">
    <div class="col-12">
        <div class="form-group">
            <button class="btn btn-danger endMatch">Mettre fin au match</button>
        </div>
    </div>
</div>


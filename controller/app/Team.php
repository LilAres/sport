<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // Les joueurs de l'équipe
    public function players(){
        return $this->hasMany(Player::class);
    }

    // La ligue dans laquelle l'équipe est classé
    public function league(){
        return $this->hasOne(League::class);
    }
}


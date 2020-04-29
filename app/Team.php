<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];

    // Les joueurs de l'équipe
    public function players(){
        return $this->belongsToMany(Player::class);
    }

    // La ligue dans laquelle l'équipe est classé
    public function league(){
        return $this->hasOne(League::class);
    }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];

    // User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Les Teams (équipe qu'il appartient)
    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    // Les statistiques du joueur
    public function stats(){
        return $this->hasMany(Stat::class);
    }
}

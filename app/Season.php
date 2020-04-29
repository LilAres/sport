<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    // À quelle league la saison appartient t'elle
    public function league(){
        return $this->belongsTo(League::class);
    }

    // Les matchs de la saisons
    public function matchs(){
        return $this->hasMany(Match::class);
    }
}

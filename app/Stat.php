<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    // Le match que la stat est liée
    public function match(){
        return $this->belongsTo(Match::class);
    }

    // Le joueur que la stat est liée
    public function player(){
        return $this->belongsTo(Player::class);
    }
}

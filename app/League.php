<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable = [
        'name', 'category'
    ];

    // Les équipes qui sont dans la league
    public function teams(){
        return $this->hasMany(Team::class);
    }

    // Les saisons
    public function seasons(){
        return $this->hasMany(Season::class);
    }
    
    
}

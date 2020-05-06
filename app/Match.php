<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

class Match extends Model
{
    protected $fillable = [
        'local_team',
        'visitor_team'
    ];
    
    public $timestamps = false;
    public $table = 'matchs';

    // La saison auquelle le match appartient
    public function season(){
        return $this->belongsTo(Season::class);
    }

    // Les stats qui sont liées au match
    public function stats(){
        return $this->hasMany(Stat::class);
    }
}

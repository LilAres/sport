<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    
    // Joueur
    public function player(){
        return $this->hasOne(Player::class);
    }

    // Les rôles
    public function roles(){
        return $this->belongsToMany(Role::class);  
    }

    public function Admin(){
        foreach($this->roles as $role){
            if($role->name == "Admin"){
                return true;
            }
        }
        return false;
    }

    public function Team_Admin(){
        foreach($this->roles as $role){
            if($role->name == "Team_Admin"){
                return true;
            }
        }
        return false;
    }

    public function Registered(){
        foreach($this->roles as $role){
            if($role->name == "Registered"){
                return true;
            }
        }
        return false;
    }




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

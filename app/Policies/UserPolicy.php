<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    public function isAdmin(User $user){
        if($user->Admin()){
            return true;
        }
        return false;
    }

    public function isTeamAdmin(User $user){
        if($user->Team_Admin()){
            return true;
        }
        return false;
    }

    public function isRegistered(User $user){
        if($user->Registered()){
            return true;
        }
        return false;
    }
}

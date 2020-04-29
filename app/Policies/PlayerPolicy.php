<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
{
    public function delete(User $user){
        if($user->Admin()){
            return true;
        }
        return false;
    }

    public function create(User $user){
        if($user->Admin() || $user->Team_Admin()){
            return true;
        }
        return false;
    }
}

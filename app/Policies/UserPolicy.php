<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    // 第一个参数: Auth:user()
    // 第二个参数：自己提供
    public function update(User $currentUser,User $user){
        return $currentUser->id === $user->id;
    }

}

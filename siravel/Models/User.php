<?php

namespace Siravel\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Model;
// use Illuminate\Contracts\Auth\Access\Authorizable;
// use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as UserAuthenticatable;
use Population\Traits\AsHuman;
use Laravel\Passport\HasApiTokens;
use SiObjects\Manipule\Builders\UserBuilder;
use Siravel\Support\Traits\Models\HasRoutine;
use Siravel\Support\Traits\Models\HasTask;


class User extends \Facilitador\Models\User
{
    /**
     * Get all of the points for the post.
     */
    public function points()
    {
        return $this->morphToMany('App\Models\Gamification\Point', 'pointable');
    }

    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }
    
    /**
     * Get all of the post's accounts.
     */
    public function accounts()
    {
        return $this->morphMany('Population\Models\Identity\Digital\Account', 'accountable');
    }

    /**
     * Worker e Tarefas
     */
    public function workers()
    {
        return $this->morphMany('Population\Models\Identity\Rotina\Worker', 'workerable');
    }
}

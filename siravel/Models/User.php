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
use Population\Manipule\Builders\UserBuilder;
use Siravel\Support\Traits\Models\HasRoutine;
use Siravel\Support\Traits\Models\HasTask;


class User extends \Facilitador\Models\User
{

    public function social()
    {
        return $this->hasMany('Informate\Models\System\Social');
    }
    

}

<?php

namespace Siravel\Models;

class User extends \Porteiro\Models\User
{

    public function social()
    {
        return $this->hasMany('Informate\Models\System\Social');
    }
    

}

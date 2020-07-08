<?php

namespace Siravel\Models;

class User extends \Facilitador\Models\User
{

    public function social()
    {
        return $this->hasMany('Informate\Models\System\Social');
    }
    

}

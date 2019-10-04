<?php

namespace App\Tools;

use Illuminate\Support\Facades\Request;

class General
{

    public function __construct()
    {
        
    }

    public static function getIp()
    {
        return Request::ip();
    }

    public static function generateToken()
    {
        // Name of selected hashing algorithm (e.g. "md5", "sha256", "haval160,4", etc..) 
        return hash('sha256', uniqid(rand(), true));
    }
}

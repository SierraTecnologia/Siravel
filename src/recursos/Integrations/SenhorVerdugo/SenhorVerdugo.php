<?php

namespace SiWeapons\Integrations\SenhorVerdugo;

use App\Models\Model;
use Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class SenhorVerdugo extends Integration
{
    public static $ID = 15;
    public function getConnection($organizer = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new SenhorVerdugo($token);
    }
}

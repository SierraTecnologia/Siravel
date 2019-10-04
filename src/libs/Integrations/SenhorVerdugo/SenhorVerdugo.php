<?php

namespace App\Logic\Connections\Integrations\SenhorVerdugo;

use App\Models\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Integration;

class SenhorVerdugo extends Integration
{
    public function getConnection($organizer = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new SenhorVerdugo($token);
    }
}

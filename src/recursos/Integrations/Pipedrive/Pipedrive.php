<?php

namespace SiWeapons\Integrations\Pipedrive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Pipedrive extends Integration
{
    protected function getConnection($token = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new Pipedrive($token);
    }
}

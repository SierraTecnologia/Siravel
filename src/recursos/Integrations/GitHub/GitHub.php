<?php

namespace SiWeapons\Integrations\GitHub;

use Illuminate\Database\Eloquent\Model;
use Log;
use SiWeapons\Integrations\Integration;

class GitHub extends Integration
{
    public static $ID = 30;

    // protected function getConnection($token = false)
    // {
    //     return new Cloudflare\API\Adapter\Guzzle(new APIKey('user@example.com', 'apiKey'));
    // }
}
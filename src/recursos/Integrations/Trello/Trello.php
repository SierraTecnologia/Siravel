<?php

namespace SiWeapons\Integrations\Trello;

use Illuminate\Database\Eloquent\Model;
use Log;
use SiWeapons\Integrations\Integration;

class Trello extends Integration
{
    public static $ID = 31;

    // protected function getConnection($token = false)
    // {
    //     return new Cloudflare\API\Adapter\Guzzle(new APIKey('user@example.com', 'apiKey'));
    // }
}
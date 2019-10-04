<?php

namespace App\Logic\Connections\Integrations\Cloudflare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Cloudflare\API\Auth\APIKey;
use App\Models\User;
use App\Logic\Connections\Integrations\Integration;

class Cloudflare extends Integration
{
    public static $ID = 10;

    protected function getConnection($token = false)
    {
        return new Cloudflare\API\Adapter\Guzzle(new APIKey('user@example.com', 'apiKey'));
    }
}

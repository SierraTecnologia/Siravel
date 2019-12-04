<?php

namespace SiWeapons\Integrations\Slack;

use Illuminate\Support\Facades\Log;
// use Siravel\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Slack extends Integration
{
    public static $ID = 25;
    public static $URL = 'https://www.Slack.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

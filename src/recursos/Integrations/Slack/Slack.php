<?php

namespace SiWeapons\Integrations\Slack;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
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

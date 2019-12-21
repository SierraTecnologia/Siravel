<?php

namespace SiWeapons\Integrations\Google;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Google extends Integration
{
    public static $ID = 6;
    public static $URL = 'https://www.google.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

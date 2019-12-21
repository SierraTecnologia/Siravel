<?php

namespace SiWeapons\Integrations\Youtube;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Youtube extends Integration
{
    public static $ID = 24;
    public static $URL = 'https://www.youtube.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

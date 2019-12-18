<?php

namespace SiWeapons\Integrations\Pinterest;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Pinterest extends Integration
{
    public static $ID = 10;
    public static $URL = 'https://www.pinterest.es/pin/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

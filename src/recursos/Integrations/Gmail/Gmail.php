<?php

namespace SiWeapons\Integrations\Gmail;

use Log;
// use Finder\Models\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Gmail extends Integration
{
    public static $ID = 5;
    public static $URL = 'https://www.gmail.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

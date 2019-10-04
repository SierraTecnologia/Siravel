<?php

namespace SiWeapons\Integrations\Xvideos;

use Illuminate\Support\Facades\Log;
// use App\Models\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Xvideos extends Integration
{
    public static $ID = 7;
    public static $URL = 'https://www.xvideos.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

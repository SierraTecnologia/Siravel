<?php

namespace SiWeapons\Integrations\Google;

use Illuminate\Support\Facades\Log;
// use Siravel\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Google extends Integration
{
    public static $ID = 22;
    public static $URL = 'https://www.google.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

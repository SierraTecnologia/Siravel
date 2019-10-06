<?php

namespace SiWeapons\Integrations\Youtube;

use Illuminate\Support\Facades\Log;
// use Siravel\Models\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Youtube extends Integration
{
    public static $ID = 6;
    public static $URL = 'https://www.youtube.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

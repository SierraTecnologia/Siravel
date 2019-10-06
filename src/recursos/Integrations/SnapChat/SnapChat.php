<?php

namespace SiWeapons\Integrations\SnapChat;

use Illuminate\Support\Facades\Log;
// use Siravel\Models\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class SnapChat extends Integration
{
    public static $ID = 7;
    public static $URL = 'https://www.snapchat.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

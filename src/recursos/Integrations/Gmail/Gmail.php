<?php

namespace SiWeapons\Integrations\Gmail;

use Illuminate\Support\Facades\Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Gmail extends Integration
{
    public static $ID = 6;
    public static $URL = 'https://www.gmail.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

<?php

namespace SiWeapons\Integrations\ZohoMail;

use Illuminate\Support\Facades\Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class ZohoMail extends Integration
{
    public static $ID = 25;
    public static $URL = 'https://www.zohoMail.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

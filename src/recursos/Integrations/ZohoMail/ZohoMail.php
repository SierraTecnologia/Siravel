<?php

namespace SiWeapons\Integrations\ZohoMail;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class ZohoMail extends Integration
{
    public static $ID = 26; // Proxima é 29, por causa do camera prive e amazon
    public static $URL = 'https://www.zohomail.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

<?php

namespace SiWeapons\Integrations\ZohoMail;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class ZohoMail extends Integration
{
    public static $ID = 26; // Proxima é 28, por causa do camera prive
    public static $URL = 'https://www.zohoMail.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

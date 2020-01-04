<?php

namespace SiWeapons\Integrations\ZohoMail;

use Log;
// use Population\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class ZohoMail extends Integration
{
    /**
     * Proxima é 32, por causa do camera prive e amazon, BitBucket, GitHub, Trello
     */
    public static $ID = 26;
    public static $URL = 'https://www.zohomail.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

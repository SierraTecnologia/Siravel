<?php

namespace SiWeapons\Integrations\Linkedin;

use Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Linkedin extends Integration
{
    public static $ID = 10;
    public static $URL = 'https://www.linkedin.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

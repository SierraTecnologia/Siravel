<?php

namespace SiWeapons\Integrations\Linkedin;

use Illuminate\Support\Facades\Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Linkedin extends Integration
{
    public static $ID = 23;
    public static $URL = 'https://www.linkedin.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

<?php

namespace SiWeapons\Integrations\Zoho;

use Illuminate\Support\Facades\Log;
// use Informate\Models\Entytys\Digital\Midia\Video;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Zoho extends Integration
{
    public static $ID = 24;
    public static $URL = 'https://www.zoho.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

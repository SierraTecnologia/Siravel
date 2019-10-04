<?php

namespace App\Logic\Connections\Integrations\Youtube;

use Illuminate\Support\Facades\Log;
// use App\Models\Midia\Video;
use App\Models\User;
use App\Logic\Connections\Integrations\Integration;

class Youtube extends Integration
{
    public static $ID = 6;
    public static $URL = 'https://www.youtube.com/';

    public function getConnection($organizer = false)
    {
        return false;
    }
}

<?php

namespace SiWeapons\Integrations\Facebook;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Facebook extends Integration
{

    public static $ID = 2;
    
    public function __construct()
    {
        
    }

    public function getNewDataForComponent($component)
    {

    }

}

<?php

namespace SiWeapons\Products\SitecBoss;

use App\Models\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class SitecBoss extends Integration
{
    public function getConnection($organizer = false)
    {
        return true;
    }
}

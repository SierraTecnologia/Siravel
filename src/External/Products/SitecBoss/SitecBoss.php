<?php

namespace App\Logic\Connections\Integrations\SitecBoss;

use App\Models\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Integration;

class SitecBoss extends Integration
{
    public function getConnection($organizer = false)
    {
        return true;
    }
}

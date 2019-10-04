<?php
/**
 * Novare é um sistema 
 * https://app.novare.vc
 * ricardo@getbilo.com
 * g4...
 */

namespace App\Logic\Connections\Integrations\Novare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Integration;

class Novare extends Integration
{
    protected function getConnection($token = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new Novare($token);
    }
}

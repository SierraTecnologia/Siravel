<?php
/**
 * Novare é um sistema 
 * https://app.novare.vc
 * ricardo@getbilo.com
 * g4...
 */

namespace SiWeapons\Integrations\Novare;

use Illuminate\Database\Eloquent\Model;
use Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Novare extends Integration
{
    public static $ID = 11;
    protected function getConnection($token = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new Novare($token);
    }
}

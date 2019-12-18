<?php
/**
 * Integração com o Test Link.
 * 
 * Equipe de Qa
 */

namespace SiWeapons\Integrations\Testlink;

use Illuminate\Database\Eloquent\Model;
use Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;

class Testlink extends Integration
{
    protected function getConnection($token = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new Testlink($token);
    }
}

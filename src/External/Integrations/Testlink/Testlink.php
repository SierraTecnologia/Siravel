<?php
/**
 * Integração com o Test Link.
 * 
 * Equipe de Qa
 */

namespace App\Logic\Connections\Integrations\Testlink;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Integration;

class Testlink extends Integration
{
    protected function getConnection($token = false)
    {
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
        return new Testlink($token);
    }
}

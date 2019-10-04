<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace App\Logic\Modules\Treinne\Cap1Basico;

use App\Models\User;
use App\Models\Role;
use App\Models\Gateway;
use App\Models\FraudAnalysi;
use App\Models\TrackingType;
use Illuminate\Support\Facades\DB;

use App\Models\Code\Project;

use App\Models\Business\Business;
use App\Models\Business\Collaborator;

use App\Models\Integrations\Token;
use App\Models\Integrations\TokenAccess;

use App\Logic\Connections\Integrations\Cloudflare\Cloudflare;

class Perfil
{
    public $skills = false;

    public static function run()
    {
       self::skills();
    }

    public static function skills()
    {
        $this->skills = [
            [
                'name' => 'Gerais'
            ],
            [
                'name' => 'Marketing'
            ],
            [
                'name' => 'Programação'
            ]
        ];
    }
}

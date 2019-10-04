<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace App\Logic\Modules\Treinne\Provas\Geral;

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

class Geral
{
    public $sitec = false;

    public static function run()
    {
       self::provas();
    }

    public static function provas()
    {
        // Testa oq o aluno sabe sobre git
        Prova::firstOrCreate([
            'name'              => 'Git',
        ]);
    }
}

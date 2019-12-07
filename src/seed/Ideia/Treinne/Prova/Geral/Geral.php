<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Ideia\Treinne\Provas\Geral;

use App\Models\User;
use App\Models\Role;
use App\Models\Gateway;
use App\Models\FraudAnalysi;
use App\Models\TrackingType;
use Illuminate\Support\Facades\DB;

use Informate\Models\Entytys\Digital\Code\Project;

use Population\Models\Identity\Actors\Business;
use Population\Models\Market\Business\Collaborator;

use Informate\Models\Components\Integrations\Token;
use Informate\Models\Components\Integrations\TokenAccess;

use SiWeapons\Integrations\Cloudflare\Cloudflare;

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

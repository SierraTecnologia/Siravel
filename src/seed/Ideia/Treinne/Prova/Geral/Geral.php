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

use Siravel\Models\Entytys\Digital\Code\Project;

use Siravel\Models\Identity\Actors\Business;
use Siravel\Models\Market\Business\Collaborator;

use Siravel\Models\Components\Integrations\Token;
use Siravel\Models\Components\Integrations\TokenAccess;

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

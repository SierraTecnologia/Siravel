<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Ideia\Treinne\Aprendizado\Filosofias;

use App\Models\User;
use App\Models\Role;
use App\Models\Gateway;
use App\Models\FraudAnalysi;
use App\Models\TrackingType;
use Illuminate\Support\Facades\DB;

use Informate\Models\Entytys\Digital\Code\Project;

use Population\Models\Identity\Actors\Business;
use Population\Models\Market\Business\Collaborator;

use Population\Models\Components\Integrations\Token;
use Population\Models\Components\Integrations\TokenAccess;

use SiWeapons\Integrations\Cloudflare\Cloudflare;

class ExercicioReceitaParaORatoSairDoLabirinto
{
    public $sitec = false;

    public static function run()
    {
       self::about();
    }

    public static function about()
    {
       $this->text = '';
    }
}

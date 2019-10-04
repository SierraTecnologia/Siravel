<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Treinne\Provas\Aprendizado\DandoComandos;

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

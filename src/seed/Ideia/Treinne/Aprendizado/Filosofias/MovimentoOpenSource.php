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

use SiWeapons\Models\Digital\Code\Project;

use Siravel\Models\Identity\Business\Business;
use Siravel\Models\Identity\Business\Collaborator;

use Siravel\Models\Components\Integrations\Token;
use Siravel\Models\Components\Integrations\TokenAccess;

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

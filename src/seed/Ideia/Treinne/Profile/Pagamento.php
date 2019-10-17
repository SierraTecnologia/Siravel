<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Ideia\Treinne\Cap1Basico;

use App\Models\User;
use App\Models\Role;
use App\Models\Gateway;
use App\Models\FraudAnalysi;
use App\Models\TrackingType;
use Illuminate\Support\Facades\DB;

use Siravel\Models\Digital\Code\Project;

use Siravel\Models\Identity\Business\Business;
use Siravel\Models\Identity\Business\Collaborator;

use Siravel\Models\Components\Integrations\Token;
use Siravel\Models\Components\Integrations\TokenAccess;

use SiWeapons\Integrations\Cloudflare\Cloudflare;

class Pagamento
{
    public $valueHour = 120;

    public static function run()
    {
       self::skills();
    }

    public static function porDinheiro($pesoValor = 1)
    {
        // Lorena
        // Pagamento Por Hora
        return self::$valueHour*$pesoValor;
    }

    public static function porTrabalho($hours)
    {
        // Lorena
        // Pagamento Por Hora
        return ;
    }
}

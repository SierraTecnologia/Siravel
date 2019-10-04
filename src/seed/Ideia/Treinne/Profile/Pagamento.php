<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Treinne\Cap1Basico;

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

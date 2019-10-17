<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Ideia\Treinne\Profile;

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

class Apostas
{
    public $valueHour = 120;

    public static function run()
    {
       self::seismeses();
    }

    public static function seismeses()
    {
        $X = 50; // 50 Hrs de Aula
        // Caso em menos de seis meses de aula. Vindo pelo menos uma vez a cada quinze dias.
        // Com pelo menos X horas de aulas presenciais.

        // Caso isso seja verdade!

        // EU prometo que estará tão confiante que nao recusaria um emprego por 5 mil reais
        return ;
    }
}

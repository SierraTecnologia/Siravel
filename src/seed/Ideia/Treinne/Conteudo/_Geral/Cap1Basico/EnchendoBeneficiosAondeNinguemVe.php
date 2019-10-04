<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace App\Logic\Modules\Treinne\Conteudo\_Geral\Cap1Basico;

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

class EnxergandoBeneficiosAondeNinguemMaisVe
{

    public static function run()
    {
       self::about();
    }

    /**
     * POrque é importante
     */
    public static function about()
    {
        $this->text([
            'name' => 'O que faz alguem ser foda, não é ter sorte.'.
                'E sim, a arte de se colocar no lugar de qualquer outra pessoa, e descobrir alguma forma de tirar beneficio disso !',
        ]);
    }

    /**
     * Como avançar com isso
     */
    public static function howDoIt()
    {
        $this->text();
    }
}

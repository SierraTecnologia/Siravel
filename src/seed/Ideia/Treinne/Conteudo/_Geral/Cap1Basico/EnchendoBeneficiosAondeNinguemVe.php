<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Ideia\Treinne\Conteudo\_Geral\Cap1Basico;

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

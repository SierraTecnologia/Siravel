<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Treinne\Conteudo\_Referencias;

use App\Models\User;
use App\Models\Role;
use App\Models\Gateway;
use App\Models\FraudAnalysi;
use App\Models\TrackingType;
use Illuminate\Support\Facades\DB;

use Siravel\Models\Components\Code\Project;

use Siravel\Models\Identity\Business\Business;
use Siravel\Models\Identity\Business\Collaborator;

use Siravel\Models\Components\Integrations\Token;
use Siravel\Models\Components\Integrations\TokenAccess;

use SiWeapons\Integrations\Cloudflare\Cloudflare;

class RicardoSierra
{
    public $skill = false;

    public static function run()
    {
       self::skill();
    }

    public static function skill()
    {
       $this->skill = [
            'prog' => 10,
            'empreendedorismo' => 10,
            'marketing' => 10,
       ];
    }
}

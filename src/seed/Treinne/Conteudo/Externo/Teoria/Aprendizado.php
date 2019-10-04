<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace App\Logic\Modules\Treinne\Extern\Teoria;

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

class Aprendizado
{

    public static function run()
    {
       self::playlistOne();
    }

    public static function playlistOne()
    {
        // Começando aos 40, de Fabio Akita
        Video::firstOrCreate([
            'name' => 'O Mercado de TI para Iniciantes em Programação | Série "Começando aos 40"',
            'url'              => 'https://www.youtube.com/watch?v=O76ZfAIEukE&list=PLdsnXVqbHDUc7htGFobbZoNen3r_wm3ki',
        ]);
    }
}

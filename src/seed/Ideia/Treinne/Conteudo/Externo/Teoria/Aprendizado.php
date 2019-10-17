<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiSeed\Ideia\Treinne\Extern\Teoria;

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

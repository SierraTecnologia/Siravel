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

class Livros
{
    public $resumos = false;

    public static function run()
    {
       self::resumos();
    }

    public static function resumos()
    {
        $object = new Self();
        $object->resumo(
            [
                'book' => 'As 48 leis do poder',
                'originalName' =>' The 48 Laws of Power',
                'author' => 'Robert Greene',
                'year' => '1998',
                'assuntos' => [
                    'estratégia',
                    'semi-ajuda'
                ],
                'language' => 'Inglês',
                'resumo' => 'https://www.youtube.com/watch?v=VFIZ0k78GeM'
            ]
        );
        $object->resumo(
            [
                'book' => 'A ARTE DA GUERRA',
                'author' => 'Sun Tzu',
                'year' => 'século IV a.C.',
                'language' => 'Língua chinesa',
                'assuntos' => [
                    'estratégia militar',
                    'tática militar'
                ],
                'resumo' => 'https://www.youtube.com/watch?v=p1pYC7HJlGU'
            ]
        );

        /**
         * Economia
         */
        $object->resumo(
            [
                'book' => 'Democracia - O Deus Que Falhou',
                'author' => 'Hanshermann Hoppe',
                'pages' => 372,
                'assuntos' => [
                    'democracia',
                    'politica',
                    'história'
                ],
            ]
        );
        $object->resumo(
            [
                'book' => 'Manifesto Libertário',
                'author' => 'Murray Rothbard',
                'year' => 1973,
                'assuntos' => [
                    'libertarismo'
                ],
            ]
        );
    }
}

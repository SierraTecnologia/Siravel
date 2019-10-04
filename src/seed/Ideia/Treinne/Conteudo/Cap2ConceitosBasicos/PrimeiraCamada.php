<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace App\Logic\Modules\Treinne\Conteudo\_Geral;

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

class PrimeiraCamada
{
    public $sitec = false;

    public static function run()
    {
        $this->text('Programação nada mais é doq montar quebra cabeças.');
        $this->text('Saiba doq precisa, pegue os componentes certos e monte seu quebra cabeça');
        self::isolamento();
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function isolamento()
    {
        $this->text('Primeira camada. Operações e entradas e Saidas');

        $this->text('Tipos de Entradas e Saidas:');
        $this->options([
            'texto' => 'string',
            'inteiro' => 'int',
            'decimal' => 'float',
            'verdadeiroOuFalso' => 'bolleano'
        ]);

        $this->text('Operações:');
        $this->options([
            'atribuição' => '=',
            'soma' => '=',
            'subtração' => '=',
            'soma' => '='
        ]);

        $this->text('Condições e Loopings:');
        $this->code(function (){
            $idade = 3;
            if ($idade > 18) {
                return 'Maior que 18';
            }

            return 'Menor que 18';
        });
    }
    

}
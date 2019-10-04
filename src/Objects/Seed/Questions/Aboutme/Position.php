<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace Logic\Questions\Aboutme;

use App\Http\Bots\Decisoes\Question;
use App\Models\Midia\Video;

class Position
{
    public function run()
    {
        Question::firstOrCreate([
            'question' => 'O companheiro te passou confiança ?',
            'type' => 'seguranca',
            'options' => 'bool',

            'perpective' => 'relation',
            'perpective_reference' => 'App\Models\Event',

            'requeriments' => [

            ],

            'obs' => 'Perguntar no inicia dos Relacionamentos',

            'results' => function ($each) {

            }
        ]);






        Question::firstOrCreate([
            'question' => 'O companheiro te passou confiança ?',
            'type' => 'seguranca',
            'options' => 'bool',

            'perpective' => 'relation',
            'perpective_reference' => 'App\Models\Event',

            'requeriments' => [

            ],

            'obs' => 'Perguntar no inicia dos Relacionamentos'
        ]);









        Question::firstOrCreate([
            'question' => 'Suas espectativas foram atingidas ? Descreva como foi a Sessão:',
            'type' => 'espectativa',
            'options' => 'text'
        ]);
    }

}

<?php

namespace SiSeed\Abstract\Questions;

class LikeThat extends Questions
{
    /**
     * Questões que serão Perguntadas Antes 
     */
    public function dependences()
    {
        return [
            // LikeThat::class
        ];
    }

    public function initQuestions()
    {
        return [
            Question::firstOrCreate([
                // 'question' => 'O companheiro te passou confiança ?',
                // 'type' => 'seguranca',
                // 'options' => 'bool',

                // 'perpective' => 'relation',
                // 'perpective_reference' => 'App\Models\Event',

                // 'requeriments' => [

                // ],

                // 'obs' => 'Perguntar no inicia dos Relacionamentos'
            ]),
        ];
    }

    
}
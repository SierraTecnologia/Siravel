<?php

namespace App\Logic\Info\Questions;

use App\Logic\Info\Questions\Questions;

class AboutMe extends Questions
{

    /**
     * Questões que serão Perguntadas Antes 
     */
    public function dependences()
    {
        return [
            LikeThat::class
        ];
    }

    public function init()
    {
        return [
            Question::firstOrCreate([
                'question' => 'Quais Praticas sonhas toda hora ?',
                'options' => 'options::model-Taste'
            ]),

            Question::firstOrCreate([
                'question' => 'A quantos anos prática bdsm ?',
                'options' => 'integer'
            ]),

            Question::firstOrCreate([
                'question' => 'Descreva sua melhor experiência com BDSM',
                'options' => 'text'
            ]),
        ];
    }

    
}
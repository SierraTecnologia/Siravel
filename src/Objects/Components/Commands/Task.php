<?php

namespace App\Logic\Info\Commands;

class Task
{

    /**
     * 
     *
     * @var boolean
     */
    public $isRemote = true;

    /**
     * Caso seja um trabalho. Caso demande esforço fisico
     *
     * @var boolean
     */
    public $isFisic = true;

    public function getModel()
    {
        return Task::class;
    }

    public function attributes()
    {
        return [
            'expired' => App\Fields\Boolean::class,
            'task' => App\Fields\Text::class,
        ];
    }

    
}
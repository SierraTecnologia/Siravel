<?php

namespace App\Logic\Info\Actions;

use App\Logic\Info\Actions\Fisico;

use App\Logic\Info\Steps\BasicRegister;
use App\Logic\Info\Steps\BottomInfos;

class Cuidar
{

    public static function menu()
    {
        return env('APP_FRONT', 'snowevo');
    }

    public static function steps()
    {
        return [
            'myProfile' => [
                BasicRegister::class,
                TopInfos::class
            ]
        ];
    }

    public static function senzala()
    {
        $menu = [

        ];

        $actionForUnit = [
            'Treinar',
            '',
        ];
    }


    /**
     * Sobre Um Unico Slave
     */
    public static function aboutMySlave()
    {
        return [
            [
                'caracteristicas' => false,
                'metas' => false,
                'rotina' => false,
                'compromisso' => false,

                // Retorna as Metas e Prazos
                'metas' => false,

                // Retorna as Tarefas para cada Slave
                'tasks' => false,
            ]
        ];
    }

    public static function actionsToBottom()
    {
        return [

        ];
    }

    public static function seeIn()
    {
        
    }

    
}
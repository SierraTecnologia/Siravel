<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace Logic;

class Logica
{    

    public static function getDataClasses()
    {
        return Questions/Questions::getDataClasses();
    }

    public function run()
    {
        collect(self::getDataClasses())->map(function ($class) {
            (new $class)->run();
        });
    }

}

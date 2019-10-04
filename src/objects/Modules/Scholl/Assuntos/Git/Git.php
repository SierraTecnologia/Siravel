<?php
/**
 * 
 */

namespace App\Logic\Modules\Scholl\Assuntos\Git;


class Git
{
    public $type = 'program';

    public function requeriments()
    {
        return [
            Terminal::class,
        ]
    }

    public function related()
    {
        return [
            OpenSource::class,
        ]
    }
}

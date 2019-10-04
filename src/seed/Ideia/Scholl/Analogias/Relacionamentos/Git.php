<?php
/**
 * 
 */


namespace App\Logic\Modules\Scholl\Analogias\Relacionamentos;

class Git
{

    public function analogia()
    {
        return [
            [
                'history' => Escritor::class,
                'necessidade' => new Escrever('livro'),
                'problem' => '',
            ]
        ];
    }


    public function chieldrens()
    {
        return [
            Commit::class,
            Branch::class,
        ];
    }

    public function parents()
    {
        return false;
    }
}

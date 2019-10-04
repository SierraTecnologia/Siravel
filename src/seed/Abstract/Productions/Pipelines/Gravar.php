<?php

namespace App\Logic\Info\Productions\Pipelines;

/**
 * Representa uma ação dentro da Produção
 */
class Gravar
{

    
    public function help()
    {
        $dicas = [];
        if ($this->roteiro->haveActorJob()) {
            $dicas[] = 'Procure por ator!';
        }
    }
}
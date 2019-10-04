<?php
/**
 * 
 */

namespace App\Logic\Boards;

use Illuminate\Support\Facades\Log;

class InfraBoard extends Board
{
    protected function dashboard()
    {

    }

    protected function getInteresses()
    {
        return [
            // Status dos Servidores
        ];
    }

    protected function getHooks()
    {
        return [
            // Status dos Servidores
        ];
    }

    /**
     * Se byClass nao for false, retorna todas as ações para qualquer tipo de instancia
     */
    public function getTools()
    {
        return [
            \App\Logic\Modules\Diagrams::class,
        ];
    }

}

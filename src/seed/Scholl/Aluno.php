<?php
/**
 * 
 */

namespace App\Logic\Modules\Scholl;

use Illuminate\Support\Facades\Log;

class Alunos extends Board
{

    protected function dashboard()
    {

    }

    protected function getInteresses()
    {
        return [

        ];
    }

    /**
     * 
     */
    public function getBoards()
    {
        return [
            InfraBoard::class
        ];
    }

}

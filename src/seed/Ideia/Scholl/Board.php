<?php
/**
 * 
 */

namespace App\Logic\Modules\Scholl;

use Illuminate\Support\Facades\Log;

class Board
{

    protected function dashboard()
    {
        // Tarefas


        // Profile
    }

    protected function action()
    {
        return [
            Estudar::class
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

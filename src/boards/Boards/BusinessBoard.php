<?php
/**
 * 
 */

namespace App\Logic\Boards;

use Illuminate\Support\Facades\Log;

class BusinessBoard extends Board
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

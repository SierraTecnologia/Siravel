<?php
/**
 * 
 */

namespace App\Logic\Boards\Views;

use Illuminate\Support\Facades\Log;
use App\Logic\Modules\Programs\FilePrograms;

class File extends Board
{

    public function editAction()
    {
        
    }

    public function showAction()
    {
        
    }

    /**
     * 
     */
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
    public function getPrograms()
    {

        return [
            FilePrograms::class
        ];
    }

}

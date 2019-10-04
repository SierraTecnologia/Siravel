<?php

namespace App\Logic\Connections\Plugins\Components;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Instagram;

class Comment
{
    
    public function executeRoutines()
    {
        $this->getIntegrations();
    }
    
    
    public function getIntegrations()
    {
        return [
            new Instagram()
        ];
    }
    
    public function getPosts()
    {
        
    }
    
    public function getLikes()
    {
        
    }
    
    public function getRelations()
    {
        
    }

}

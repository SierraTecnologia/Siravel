<?php

namespace App\Logic\Connections\Plugins\Components;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Instagram;

class Profile
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

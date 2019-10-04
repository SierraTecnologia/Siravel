<?php

namespace App\Logic\Connections\Plugins\Components;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Instagram;


use App\Logic\Connections\Plugins\Pipelines\Contracts\Registrator;
use App\Logic\Connections\Plugins\Pipelines\Contracts\Notificator;

class Post implements Registrator, Notificator
{

    public $comments = [];

    public $likes = [];

    protected $post;
    
    public function getPost()
    {
        return $this->post;
    }
    public function __toString()
    {
        return 'this is object Post';
    }
    
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
    
    public function getComments()
    {
        return $this->comments;
    }
    
    public function getLikes()
    {
        return $this->likes;
        
    }
    
    public function getRelations()
    {
        
    }

}

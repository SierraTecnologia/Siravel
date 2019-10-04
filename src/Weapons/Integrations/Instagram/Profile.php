<?php

namespace App\Logic\Connections\Integrations\Instagram;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Profile extends Instagram
{
    
    public function __construct()
    {
        
    }

    public function getPosts()
    {

    }

    public function getLikes()
    {

    }

    public function getRelations()
    {
        $this->getFollows();
    }

    protected function getFollows()
    {

    }

    protected function getComments()
    {

    }

}

<?php

namespace App\Logic\Connections\Integrations\Googledrive;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Profile extends Googledrive
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

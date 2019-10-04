<?php

namespace App\Logic\Connections\Integrations\Dropbox;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Profile extends Dropbox
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

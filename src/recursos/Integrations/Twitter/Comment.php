<?php

namespace SiWeapons\Integrations\Twitter;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Comment extends Twitter
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

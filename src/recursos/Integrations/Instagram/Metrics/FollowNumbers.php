<?php

namespace SiWeapons\Integrations\Instagram\Metrics;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class FollowNumbers extends Metric
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

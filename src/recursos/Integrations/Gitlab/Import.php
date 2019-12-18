<?php

namespace SiWeapons\Integrations\Gitlab;

use Log;
use App\Models\User;

class Import extends Gitlab
{
    public function projects()
    {
        $project = $client->api('projects')->create('My Project', array(
        'description' => 'This is a project',
        'issues_enabled' => false
        ));
    }
}

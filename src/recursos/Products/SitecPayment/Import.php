<?php

namespace SiWeapons\Integrations\SitecPayment;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Import extends SitecPayment
{
    public function projects()
    {
        $project = $client->api('projects')->create('My Project', array(
        'description' => 'This is a project',
        'issues_enabled' => false
        ));
    }
}

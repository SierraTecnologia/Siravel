<?php

namespace App\Logic\Connections\Integrations\SitecBoss;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Create extends SitecBoss
{
    public function project(Project $project)
    {
        $arrayFromProject = array(
            'description' => $project->description,
            'issues_enabled' => false
        );
        $project = $client->api('projects')->create($project->name, $arrayFromProject);
    }
}

<?php

namespace App\Logic\Connections\Plugins\Components;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Logic\Connections\Integrations\Instagram;

use App\Logic\Connections\Plugins\Pipelines\Contracts\Registrator;
use App\Logic\Connections\Plugins\Pipelines\Contracts\Notificator;

class Pipeline
{

    protected $pipeline;

    public function getPipeline()
    {
        return $this->pipeline;
    }
    public function __toString()
    {
        return 'this is object Pipeline';
    }
}
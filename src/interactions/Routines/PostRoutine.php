<?php

namespace App\Logic\Connections\Plugins\Routines;

use App\Logic\Connections\Plugins\Components\Pipeline;
use App\Logic\Connections\Plugins\Components\Post as PostComponent;

use App\Logic\Connections\Plugins\Pipelines\PostCreator;
use App\Logic\Connections\Plugins\Pipelines\RegistratorLog;
use App\Logic\Connections\Plugins\Pipelines\NotificationSms;
use App\Logic\Connections\Plugins\Pipelines\NotificationEmail;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class PostRoutine
{
    
    public function run()
    {
        $result = (PostCreator::getPipelines())->process( new PostComponent() );
        dd($result);


        
    }

}

<?php

namespace SiInteractions\Routines;

use SiObjects\Components\Pipeline;
use SiObjects\Components\Post as PostComponent;

use App\Pipelines\PostCreator;
use App\Pipelines\RegistratorLog;
use App\Pipelines\NotificationSms;
use App\Pipelines\NotificationEmail;

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

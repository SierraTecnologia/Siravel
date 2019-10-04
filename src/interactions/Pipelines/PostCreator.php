<?php

namespace SiInteractions\Pipelines;

use Illuminate\Support\Facades\Log;
use App\Models\User;

use App\Pipelines\Contracts\Registrator;
use App\Pipelines\Contracts\Notificator;

class PostCreator extends Pipeline
{
    public static function getPipelines()
    {
        return (new self())
        ->pipe([new RegistratorLog, 'register'])
        ->pipe([new NotificationSms, 'notification'])
        ->pipe([new NotificationEmail, 'notification']);
    }
}
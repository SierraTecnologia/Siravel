<?php

namespace App\Logic\Connections\Integrations\Sentry;

use Illuminate\Support\Facades\Log;


class Import extends Sentry
{
    public function bundle()
    {
        var_dump($this->getProjects());
        return true;
    }

}

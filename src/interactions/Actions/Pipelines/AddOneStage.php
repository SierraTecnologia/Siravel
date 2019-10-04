<?php

namespace App\Logic\Actions\Pipelines;

use League\Pipeline\Pipeline as PipelineBase;
use League\Pipeline\StageInterface;

class AddOneStage implements StageInterface
{
    public function __invoke($payload)
    {
        return $payload + 1;
    }
}

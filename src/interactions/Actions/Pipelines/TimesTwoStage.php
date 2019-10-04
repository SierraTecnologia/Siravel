<?php

namespace SiInteractions\Logic\Actions\Pipelines;

use League\Pipeline\Pipeline as PipelineBase;
use League\Pipeline\StageInterface;

class TimesTwoStage implements StageInterface
{
    public function __invoke($payload)
    {
        return $payload * 2;
    }
}

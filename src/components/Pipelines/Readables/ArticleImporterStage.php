<?php

namespace SiInteractions\Pipelines\Readables;

use League\Pipeline\Pipeline as PipelineBase;
use League\Pipeline\StageInterface;
use SiObjects\Entitys\Components\Pipeline as PipelineComponent;

use SiInteractions\Routines\Contracts\Registrator;
use SiInteractions\Routines\Contracts\Notificator;

class ArticleImporterStage implements StageInterface
{
    public function __invoke(/*PipelineComponent */$payload)
    {
        $payload->executeForEachComponent(function($component) {
            Article::create([
                'title' => $component->getTitle(),
                'content' => $component->getContent(),
                'fonte' => $component->getFonte(),
            ]);
        });
        return $payload;
    }
}

<?php

namespace SiInteractions\Actions\Pipelines\Readables;

use League\Pipeline\Pipeline as PipelineBase;
use League\Pipeline\StageInterface;
use App\Logics\Components\Pipeline as PipelineComponent;

use SiInteraction\Actions\Routines\Contracts\Registrator;
use SiInteraction\Actions\Routines\Contracts\Notificator;

class ArticleCreateStage implements StageInterface
{
    public function __invoke(/*PipelineComponent*/ $payload)
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

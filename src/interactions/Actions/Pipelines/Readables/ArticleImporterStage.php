<?php

namespace SiInteractions\Logic\Actions\Pipelines\Readables;

use League\Pipeline\Pipeline as PipelineBase;
use League\Pipeline\StageInterface;
use App\Logics\Components\Pipeline as PipelineComponent;

use App\Logic\Actions\Pipelines\Contracts\Registrator;
use App\Logic\Actions\Pipelines\Contracts\Notificator;

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

<?php
/**
 * 
 */

namespace SiInteractions\Actions\Pipelines;

use Illuminate\Support\Facades\Log;

use League\Pipeline\Pipeline as PipelineBase;
use League\Pipeline\StageInterface;
use League\Pipeline\PipelineBuilder;

use SiInteraction\Actions\Routines\Contracts\Registrator;
use SiInteraction\Actions\Routines\Contracts\Notificator;

class Pipeline extends PipelineBuilder
{

    /**
     * Se byClass nao for false, retorna todas as ações para qualquer tipo de instancia
     */
    public function getPipeline()
    {
        $pipeline = (new PipelineBase)
        ->pipe(new TimesTwoStage)
        ->pipe(new AddOneStage);

        // Returns 21
        $pipeline->process(10);
        return $pipeline;
    }

}

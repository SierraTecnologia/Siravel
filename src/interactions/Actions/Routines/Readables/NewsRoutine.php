<?php
/**
 * 
 */

namespace SiInteractions\Logic\Actions\Routines\Readables;

use Illuminate\Support\Facades\Log;
use App\Logic\Entitys\Components\Pipeline as PipelineComponent;
use App\Logic\Actions\Pipelines\ArticlePipeline;
use App\Logic\Actions\Pipelines\Readables\RrsImporterStage;
use Exception;

class NewsRoutine
{

    /**
     * Se byClass nao for false, retorna todas as ações para qualquer tipo de instancia
     */
    public function run()
    {

        $payload = PipelineComponent(Rrs::all());
        $pipeline = ArticlePipeline::getPipeline();
            
        try {
            $pipeline->process($payload);
        } catch(Exception $e) {
            // Handle the exception.
        }

        return true;
    }

}

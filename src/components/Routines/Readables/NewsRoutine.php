<?php
/**
 * 
 */

namespace SiInteractions\Routines\Readables;

use Illuminate\Support\Facades\Log;
use App\Logic\ComponentsPipeline as PipelineComponent;
use SiInteractions\Routines\ArticlePipeline;
use SiInteractions\Routines\Readables\RrsImporterStage;
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

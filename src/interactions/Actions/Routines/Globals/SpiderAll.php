<?php
/**
 * Estatisticas Rodadas Diariamente
 */

namespace SiInteractions\Logic\Actions\Routines\Globals;

use App\Logic\Actions\Routines\Database\SpiderRoutine;

use App\Actions\Action;
use App\Actions\ActionCollection;
use App\Logic\Actions\Worker\Sync\Database\SpiderCollection;

use App\Models\Infra\Domain;

class SpiderAll extends ActionCollection
{

    /**
     * Avisa se precisa de Alvos Externos ou nao e descreve eles
     */
    public $externalTargetCounts = 0;
    
    public function prepare()
    {
        // Spider de Todos os Bancos de Dados
        $domains = Domain::all();
        $this->othersTargets = count($domains);
        foreach ($domains as $domain) {
            $spiderRoutine = new SpiderRoutine();
            $spiderRoutine->prepareTargets($domain);
            $this->newAction($spiderRoutine);
        }
        return parent::prepare();
    }

}

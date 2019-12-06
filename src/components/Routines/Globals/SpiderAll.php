<?php
/**
 * Estatisticas Rodadas Diariamente
 */

namespace SiInteractions\Routines\Globals;

use SiInteractions\Routines\Database\SpiderRoutine;

use App\Actions\Action;
use App\Actions\ActionCollection;
use SiInteractions\Worker\Sync\Database\SpiderCollection;

use Informate\Models\Entytys\Digital\Infra\Domain;

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

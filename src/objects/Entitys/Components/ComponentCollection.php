<?php
/**
 * 
 */

namespace SiObjects\Entitys\Components;

use App\Models\Bot\Runner;
use Illuminate\Support\Facades\Log;
use MathPHP\Functions\Map\Single;

class ComponentCollection implements \App\Contracts\Robot
{
    /**
     * Array de Array de Components, o Indice seria o Stage. 
     * 
     * O Stage 2 só começa a ser executado depois que o Stage 1 está completo!
     */
    public $componentsToExecute = [];

    public $componentsActors = [];

    public $runners = [];

    public $paramsToExecute = [];

    public $othersTargets = 0;

    public $actualStage = 0;

    /**
     * Numero de Components ja Executadas
     */
    public $executedComponents = 0;

    protected $isPrepared = false;

    protected $isComplete = false;

    protected function completeRunner($runner)
    {
        $this->executedComponents = $this->executedComponents+1;
        Log::notice('Runner Completada. Concluido:'.$this->getPorcDone());
    }

    public function getComponentToExecute()
    {
        return $this->componentsToExecute[$this->actualStage];
    }

    public function getRunners()
    {
        return $this->runners[$this->actualStage];
    }

    public function prepare()
    {
        if ($this->isPrepared) {
            return true;
        }

        if (!isset($this->runners[$this->actualStage])) {
            $this->runners[$this->actualStage] = [];
        }

        $totalComponentsCount = 0;
        foreach($this->getComponentToExecute() as $indice=>$component) {
            if ($component instanceof ComponentCollection) {
                $this->runners[$this->actualStage] = $component->prepare();
            } else {
                $this->runners[$this->actualStage] = (new Runner())->usingComponent($component)->usingTarget($this->getActor($this->componentsActors[$this->actualStage][$indice]))->prepare();
            }
            $totalComponentsCount = $totalComponentsCount + 1;
        }

        $this->isPrepared = true;
        return $this;
    }

    public function execute()
    {
        foreach($this->runners as $indice=>$runner) {
            $this->runners[$indice]->execute();
            $this->completeRunner($runner);
        }
    }

    public function done()
    {
        return $this;
    }

    public function run()
    {
        $this->prepare();
        $this->execute();
        $this->done();
    }

    public function totalStages()
    {
        return count($this->componentsToExecute);
    }

    protected function getActor($number)
    {
        $variableName = 'externalTarget'.$this->getNamberName($number).'Instance';
        return $this->$variableName;
    }

    private function getNamberName($number)
    {
        if ($number == 0 ) {
            return 'Zero';
        }
        if ($number == 1 ) {
            return 'One';
        }
        if ($number == 2 ) {
            return 'Two';
        }
        if ($number == 3 ) {
            return 'Tree';
        }
        return 'I dont now';
    }

    public function getTotalComponentsCount()
    {
        $totalComponentsCount = 0;
        foreach($this->componentsToExecute as $component) {
            $sumInCount = 1;
            if (method_exists($component, 'getTotalComponentsCount')) {
                $sumInCount = $component->getTotalComponentsCount();
            }
            $totalComponentsCount = $totalComponentsCount + $sumInCount;
        }
        return $totalComponentsCount;
    }

    public function getTotalTargetsCount()
    {
        return $this->othersTargets + $this->externalTargetCounts;
    }

    public function getPorcDone()
    {
        // (porc * total)/100 = agora
        // porc = agora*100 / total
        return Single::divide(Single::multiply([$this->executedComponents], 100), $this->getTotalComponentsCount())[0];
    }

    public function newComponent($component, int $stage = 0, int $actorNumber = 0)
    {
        $this->componentsToExecute[$stage][] = $component;
        $this->componentsActors[$stage][] = $actorNumber;
    }

    public function includeCollection(ComponentCollection $collection, $stage, $component)
    {
        // @todo Fazer
    }

    public function getComponentsToExecute()
    {
        return $this->paramsToExecute;   
    }

    public function initProcess()
    {
        
    }
}

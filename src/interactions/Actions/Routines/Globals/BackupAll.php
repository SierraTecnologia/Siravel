<?php
/**
 * Estatisticas Rodadas Diariamente
 */

namespace SiInteractions\Logic\Actions\Routines\Globals;

use App\Logic\Actions\Routines\Database\BackupRoutine;

use App\Actions\Action;
use App\Actions\ActionCollection;
use App\Logic\Actions\Worker\Sync\Database\BackupCollection;

use App\Models\Infra\Database;
use App\Models\Infra\DatabaseCollection;

class BackupAll extends ActionCollection
{

    /**
     * Avisa se precisa de Alvos Externos ou nao e descreve eles
     */
    public $externalTargetCounts = 0;
    
    public function prepare()
    {
        // Backup de Todos os Bancos de Dados
        $databaseCollections = DatabaseCollection::all();
        $this->othersTargets = count($databaseCollections);
        foreach ($databaseCollections as $databaseCollection) {
            $backupRoutine = new BackupRoutine();
            $backupRoutine->prepareTargets($databaseCollection);
            $this->newAction($backupRoutine);
        }
        return parent::prepare();
    }

}

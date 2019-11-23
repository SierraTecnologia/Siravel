<?php
/**
 * Estatisticas Rodadas Diariamente
 */

namespace SiInteractions\Routines\Globals;

use SiInteractions\Routines\Database\BackupRoutine;

use App\Actions\Action;
use App\Actions\ActionCollection;
use SiInteractions\Worker\Sync\Database\BackupCollection;

use Siravel\Models\Entytys\Digital\Infra\Database;
use Siravel\Models\Entytys\Digital\Infra\DatabaseCollection;

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

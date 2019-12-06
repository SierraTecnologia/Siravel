<?php
/**
 * Estatisticas Rodadas Diariamente
 */

namespace SiInteractions\Routines\Globals;

use SiInteractions\Routines\Tokens\ImportRoutine;

use App\Actions\Action;
use App\Actions\ActionCollection;
use Informate\Models\Components\Integrations\Token;
use Informate\Models\Components\Integrations\TokenAccess;

class ImportTokens extends ActionCollection
{

    /**
     * Avisa se precisa de Alvos Externos ou nao e descreve eles
     */
    public $externalTargetCounts = 0;
    
    public function prepare()
    {

        // Import de Todos os Bancos de Dados
        $tokens = Token::all();
        $this->othersTargets = count($tokens);
        foreach ($tokens as $token) {
            $importRoutine = new ImportRoutine();
            $importRoutine->prepareTargets($token);
            $this->newAction($importRoutine);
        }
        return parent::prepare();
    }

}

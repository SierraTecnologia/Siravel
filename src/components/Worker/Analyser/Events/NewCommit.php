<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiInteractions\Worker\Analyser\Events;

use Siravel\Models\Entytys\Digital\Code\Commit;
use Siravel\Models\Entytys\Digital\Infra\Pipeline;

class NewCommit
{
    public function __construct(Commit $commit)
    {

        // $pipeline = Pipeline::create([

        // ]);

        // Analisa o Commit

        $analyser = $commit;
    }
}

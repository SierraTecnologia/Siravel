<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiInteractions\Actions\Worker\Analyser\Event;

use Siravel\Models\Digital\Code\Commit;
use Siravel\Models\Digital\Infra\Pipeline;

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

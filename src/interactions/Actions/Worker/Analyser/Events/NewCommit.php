<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiInteractions\Actions\Worker\Analyser\Event;

use App\Models\Code\Commit;
use App\Models\Infra\Pipeline;

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

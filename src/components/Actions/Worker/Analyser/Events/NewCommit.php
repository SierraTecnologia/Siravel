<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiInteractions\Actions\Worker\Analyser\Event;

use SiWeapons\Models\Digital\Code\Commit;
use SiWeapons\Models\Digital\Infra\Pipeline;

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

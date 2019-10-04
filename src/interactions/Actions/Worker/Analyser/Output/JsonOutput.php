<?php
namespace App\Logic\Actions\Worker\Analyser\Output;

use App\Logic\Actions\Worker\Analyser\AnalysisResult;

class JsonOutput extends AbstractOutput
{
    /**
     * @inheritdoc
     */
    public function result(AnalysisResult $result)
    {
        $this->cli->out(json_encode($result->toArray()));
    }
}

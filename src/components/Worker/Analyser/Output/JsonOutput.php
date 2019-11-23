<?php
namespace SiInteractions\Worker\Analyser\Output;

use SiInteractions\Worker\Analyser\AnalysisResult;

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

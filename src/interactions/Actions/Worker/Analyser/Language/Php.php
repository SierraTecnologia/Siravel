<?php
namespace SiInteractions\Actions\Worker\Analyser\Language;

use App\Logic\Actions\Worker\Analyser\Output\AbstractOutput;
use App\Logic\Actions\Worker\Analyser\Output\Filter\OutputFilterInterface;
use App\Logic\Actions\Worker\Analyser\Output\TriggerableInterface;

/**
 * Run all script analysers and outputs their result.
 */
class Php
{
    /**
     * List of PHP analys integration classes.
     * @return string[] array of class names.
     */
    protected static function getAnalysisToolsClasses()
    {
        return [
            'App\Logic\Actions\Worker\Analyser\Tools\CodeSniffer',
            'App\Logic\Actions\Worker\Analyser\Tools\CopyPasteDetector',
            'App\Logic\Actions\Worker\Analyser\Tools\MessDetector',
        ];
    }
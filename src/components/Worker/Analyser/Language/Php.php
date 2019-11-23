<?php
namespace SiInteractions\Worker\Analyser\Language;

use SiInteraction\Actions\Worker\Analyser\Output\AbstractOutput;
use SiInteraction\Actions\Worker\Analyser\Output\Filter\OutputFilterInterface;
use SiInteraction\Actions\Worker\Analyser\Output\TriggerableInterface;

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
            'SiInteraction\Actions\Worker\Analyser\Tools\CodeSniffer',
            'SiInteraction\Actions\Worker\Analyser\Tools\CopyPasteDetector',
            'SiInteraction\Actions\Worker\Analyser\Tools\MessDetector',
        ];
    }
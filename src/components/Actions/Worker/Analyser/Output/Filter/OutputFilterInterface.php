<?php
namespace SiInteractions\Actions\Worker\Analyser\Output\Filter;

/**
 * Output filters limit the data returned by a \SiInteraction\Actions\Worker\Analyser\AnalysisResult object.
 */
interface OutputFilterInterface
{
    /**
     * Filter data returned by a \SiInteraction\Actions\Worker\Analyser\AnalysisResult object.
     * @param $data array a list of the file paths and their issues.
     * @return array filtered data array.
     */
    public function filter($data);
}
<?php
/**
 * Se liga a diversas Outras Tabelas atraves do:
 * atraves do
 * model_id
 * model
 */


namespace Siravel\Models\Traits;

trait ComplexRelationamentTrait
{
    // Acrescentar na tabela
    // protected static $COMPLEX_RELATIONAMENT_MODELS = [
    //     \App\Models\Qa\AnalyzerResult::class
    // ];

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
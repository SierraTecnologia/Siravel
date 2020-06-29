<?php
/**
 * Possui Tabelas que se ligam a essa tabela
 * atraves do
 * model_id
 * model
 */

namespace Siravel\Models\Traits;

trait ComplexRelationamentInTrait
{
    // Acrescentar na tabela
    // protected static $COMPLEX_RELATIONAMENT_IN_MODELS = [
    //     \App\Models\Bot\Task::class
    // ];

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
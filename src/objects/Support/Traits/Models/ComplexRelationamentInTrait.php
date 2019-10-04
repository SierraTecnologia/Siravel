<?php
/**
 * Possui Tabelas que se ligam a essa tabela
 * atraves do
 * model_id
 * model
 */

namespace SiObjects\Support\Traits\Support\Models;

trait ComplexRelationamentInTrait
{
    // Acrescentar na tabela
    // protected static $COMPLEX_RELATIONAMENT_IN_MODELS = [
    //     \Siravel\Models\Actions\Bot\Task::class
    // ];

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
<?php
/**
 * @todo deletar, tem em muleta
 */

namespace Siravel\Models\Traits;

trait EloquentGetTableNameTrait
{

    public static function getTableName(): string
    {
        return ((new self)->getTable());
    }

}
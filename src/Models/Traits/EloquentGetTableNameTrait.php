<?php
/**
 * @todo deletar, tem em muleta
 */

namespace Siravel\Models\Traits;

trait EloquentGetTableNameTrait
{

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
<?php

namespace Siravel\Models\Traits;

trait EloquentGetTableNameTrait
{

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
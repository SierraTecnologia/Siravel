<?php

namespace SiObjects\Support\Traits\Models;

trait EloquentGetTableNameTrait
{

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
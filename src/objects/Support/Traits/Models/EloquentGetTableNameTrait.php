<?php

namespace SiObjects\Support\Traits\Support\Models;

trait EloquentGetTableNameTrait
{

    public static function getTableName()
    {
        return ((new self)->getTable());
    }

}
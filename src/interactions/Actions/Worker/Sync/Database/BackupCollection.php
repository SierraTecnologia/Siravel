<?php
/**
 * 
 */

namespace App\Logic\Actions\Worker\Sync\Database;

use App\Logic\Tools\Databases\Mysql\Mysql as MysqlTool;
use App\Models\Infra\DatabaseCollection;

class BackupCollection
{

    protected $collection = false;

    public function __construct(DatabaseCollection $collection)
    {
        $this->collection = $collection;
    }

    public function execute()
    {
        return (new MysqlTool($this->collection))->export();
    }
}

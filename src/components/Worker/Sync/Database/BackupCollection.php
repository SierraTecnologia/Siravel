<?php
/**
 * 
 */

namespace SiInteractions\Worker\Sync\Database;

use SiUtils\Tools\Databases\Mysql\Mysql as MysqlTool;
use Population\Models\Entytys\Digital\Infra\DatabaseCollection;

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

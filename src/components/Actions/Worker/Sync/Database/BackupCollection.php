<?php
/**
 * 
 */

namespace SiInteractions\Actions\Worker\Sync\Database;

use App\Logic\Tools\Databases\Mysql\Mysql as MysqlTool;
use SiWeapons\Models\Digital\Infra\DatabaseCollection;

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

<?php

namespace App\Logic\Tools\Model;

use App\Logic\Tools\Store\Factory;
use App\Models\Infra\Ci\Base\ProjectGroup as BaseProjectGroup;
use App\Logic\Tools\Store\ProjectStore;

class ProjectGroup extends BaseProjectGroup
{
    /**
     * @return Project[]
     */
    public function getGroupProjects()
    {
        /** @var ProjectStore $projectStore */
        $projectStore = Factory::getStore('Project');

        return $projectStore->getByGroupId($this->getId(), false);
    }
}

<?php

namespace Siravel\Logic\Tools\Model;

use Siravel\Logic\Tools\Store\Factory;
use Siravel\Models\Infra\Ci\Base\ProjectGroup as BaseProjectGroup;
use Siravel\Logic\Tools\Store\ProjectStore;

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

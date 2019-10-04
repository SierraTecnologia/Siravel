<?php

namespace App\Logic\Tools\Model;

use App\Models\Infra\Ci\Base\BuildMeta as BaseBuildMeta;
use App\Logic\Tools\Store\BuildStore;
use App\Logic\Tools\Store\Factory;

class BuildMeta extends BaseBuildMeta
{
    /**
     * @return Build|null
     */
    public function getBuild()
    {
        $buildId = $this->getBuildId();
        if (empty($buildId)) {
            return null;
        }

        /** @var BuildStore $buildStore */
        $buildStore = Factory::getStore('Build');

        return $buildStore->getById($buildId);
    }
}

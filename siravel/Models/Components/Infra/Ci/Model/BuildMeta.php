<?php

namespace Siravel\Logic\Tools\Model;

use Siravel\Models\Infra\Ci\Base\BuildMeta as BaseBuildMeta;
use Siravel\Logic\Tools\Store\BuildStore;
use Siravel\Logic\Tools\Store\Factory;

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

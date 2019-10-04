<?php

namespace SiUtils\Tools\Model;

use Siravel\Models\Components\Infra\Ci\Base\BuildMeta as BaseBuildMeta;
use SiUtils\Tools\Store\BuildStore;
use SiUtils\Tools\Store\Factory;

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

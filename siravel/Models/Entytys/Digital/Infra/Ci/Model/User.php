<?php

namespace SiUtils\Tools\Model;

use SiUtils\Tools\Config;
use Siravel\Models\Entytys\Digital\Infra\Ci\Base\User as BaseUser;

/**
 * @author Ricardo Sierra <ricardo@sierratecnologia.com>
 */
class User extends BaseUser
{
    /**
     * @return int
     */
    public function getFinalPerPage()
    {
        $perPage = $this->getPerPage();
        if ($perPage) {
            return $perPage;
        }

        return (int)Config::getInstance()->get('php-censor.per_page', 10);
    }
}
<?php

namespace App\Logic\Tools\Model;

use App\Logic\Tools\Config;
use App\Models\Infra\Ci\Base\User as BaseUser;

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

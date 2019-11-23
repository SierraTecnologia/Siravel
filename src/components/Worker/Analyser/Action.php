<?php

namespace SiInteractions\Worker\Explorer;

use Siravel\Models\Entytys\Digital\Infra\Domain;
use Siravel\Models\Entytys\Digital\Internet\Url;
use Siravel\Models\Entytys\Digital\Internet\UrlLink;

/**
 * Action Class
 *
 * @class  Action
 * @package playground
 */
class Action {

    protected $url = false;

    protected $domain = false;

    protected $playground = false;

    protected $follow = false;
    
    public function __construct()
    {

    }

    public function execute()
    {
        return true;
    }
}

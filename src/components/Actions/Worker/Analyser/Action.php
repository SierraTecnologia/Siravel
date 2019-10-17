<?php

namespace SiInteractions\Actions\Worker\Explorer;

use Siravel\Models\Digital\Infra\Domain;
use Siravel\Models\Digital\Internet\Url;
use Siravel\Models\Digital\Internet\UrlLink;

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

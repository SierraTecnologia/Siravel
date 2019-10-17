<?php

namespace SiInteractions\Actions\Worker\Explorer;

use Siravel\Models\Components\Infra\Domain;
use Siravel\Models\Actions\Bot\Internet\Url;
use Siravel\Models\Actions\Bot\Internet\UrlLink;

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

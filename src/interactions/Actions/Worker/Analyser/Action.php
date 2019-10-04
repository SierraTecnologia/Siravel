<?php

namespace SiInteractions\Actions\Worker\Explorer;

use Siravel\Models\Components\Infra\Domain;
use App\Models\Bot\Internet\Url;
use App\Models\Bot\Internet\UrlLink;

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

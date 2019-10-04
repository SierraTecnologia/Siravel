<?php

namespace SiInteractions\Actions\Worker\Explorer;

use Siravel\Models\Components\Infra\Domain;
use Siravel\Models\Components\Infra\SubDomain;
use Siravel\Models\Components\Infra\DomainLink;

/**
 * Spider Class
 *
 * @class  Spider
 * @package crawler
 */
class Whois {

    protected $domain = false;

    
    public function __construct($domain)
    {

        $this->domain = $domain;
    }

    public function execute()
    {
        
    }

}

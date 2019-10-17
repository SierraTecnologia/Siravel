<?php

namespace SiInteractions\Actions\Worker\Explorer;

use SiWeapons\Models\Digital\Infra\Domain;
use SiWeapons\Models\Digital\Infra\SubDomain;
use SiWeapons\Models\Digital\Infra\DomainLink;

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

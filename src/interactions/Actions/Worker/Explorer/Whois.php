<?php

namespace SiInteractions\Actions\Worker\Explorer;

use App\Models\Infra\Domain;
use App\Models\Infra\SubDomain;
use App\Models\Infra\DomainLink;

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

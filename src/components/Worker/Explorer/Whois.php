<?php

namespace SiInteractions\Worker\Explorer;

use Informate\Models\Entytys\Digital\Infra\Domain;
use Informate\Models\Entytys\Digital\Infra\SubDomain;
use Informate\Models\Entytys\Digital\Infra\DomainLink;

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

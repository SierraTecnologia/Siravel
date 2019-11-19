<?php

namespace SiInteractions\Actions\Worker\Explorer;

use Siravel\Models\Entytys\Digital\Infra\Domain;
use Siravel\Models\Entytys\Digital\Infra\SubDomain;
use Siravel\Models\Entytys\Digital\Infra\DomainLink;

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

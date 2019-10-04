<?php

namespace Siravel\Http\Controllers\Api;

use Response;
use Siravel\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Siravel\Models\User;
use Siravel\Sitec\Business;

class Controller extends BaseController
{
    public $_business = null;

    public function __construct()
    {
        parent::__construct();
        $this->_business = $this->getBusiness();
    }

    /**
     * Tenta capturar um token para o business via SERVER, POST, ou GET
     * Caso não ache ele usa o token padrão da passepague
     */
    public function getBusiness()
    {
        if (!empty($this->_business)){
            return $this->_business;
        }
        
        return $this->_business = Business::getViaParamsToken();
    }

}

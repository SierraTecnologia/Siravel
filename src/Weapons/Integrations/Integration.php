<?php

namespace App\Logic\Connections\Integrations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;

use App\Models\Integrations\Token;

use App\Logic\Connections\Integrations\Github\Github;
use App\Logic\Connections\Integrations\Amazon\Amazon;
use App\Logic\Connections\Integrations\Gitlab\Gitlab;
use App\Logic\Connections\Integrations\Jira\Jira;
use App\Logic\Connections\Integrations\Novare\Novare;
use App\Logic\Connections\Integrations\Pipedrive\Pipedrive;
use App\Logic\Connections\Integrations\Sentry\Sentry;
use App\Logic\Connections\Integrations\Testlink\Testlink;
use App\Logic\Connections\Integrations\Zoho\Zoho;

class Integration
{

    protected $_connection = null;

    protected $_token = null;

    private $error = null;

    private $errorCode = null;

    public function __construct($token = false)
    {
        $this->_token = $token;
        $this->_connection = $this->getConnection($this->_token);
    }

    /**
     * Recupera connecção com a integração
     */
    protected function getConnection($token = false)
    {
        return $this;
    }

    public function setError($errorMessage, $code = 0)
    {
        $this->error = $errorMessage;
        $this->errorCode = $code;
        var_dump($errorMessage);
    }

    public function getError()
    {
        return $this->error;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Recupera dados em cima de um get de uma api
     */
    public function get($path)
    {
        // @todo Fazer resultar um object em cia de um path
        $url = $this->url.$path;
        $result = [];
        return $result;
    }

    // protected $_connection = null;

    // private $error = null;

    // private $errorCode = null;

    // public function __construct(User $organizer)
    // {
    //     $this->_connection = $this->getConnection($organizer);
    // }

    // /**
    //  * Recupera connecção com a integração
    //  */
    // protected function getConnection($organizer = false)
    // {
    //     return $this;
    // }

    // public function getError()
    // {
    //     return $this->error;
    // }

    // public function getUrl()
    // {
    //     return static::$url;
    // }

    // public function getErrorCode()
    // {
    //     return $this->errorCode;
    // }

    // /**
    //  * Recupera dados em cima de um get de uma api
    //  */
    // public function get($path)
    // {
    //     // @todo Fazer resultar um object em cia de um path
    //     $url = $this->url.$path;
    //     $result = [];
    //     return $result;
    // }
}

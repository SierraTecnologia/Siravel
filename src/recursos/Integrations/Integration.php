<?php

namespace SiWeapons\Integrations;

use Illuminate\Database\Eloquent\Model;
use Log;
use App\Models\User;

use Population\Models\Components\Integrations\Token;

use SiWeapons\Integrations\Github\Github;
use SiWeapons\Integrations\Amazon\Amazon;
use SiWeapons\Integrations\Gitlab\Gitlab;
use SiWeapons\Integrations\Jira\Jira;
use SiWeapons\Integrations\Novare\Novare;
use SiWeapons\Integrations\Pipedrive\Pipedrive;
use SiWeapons\Integrations\Sentry\Sentry;
use SiWeapons\Integrations\Testlink\Testlink;
use SiWeapons\Integrations\Zoho\Zoho;


use Population\Models\Components\Integrations\Integration as IntegrationModel;

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

    /**
     * Recupera dados em cima de um get de uma api
     */
    public static function getCodeForPrimaryKey()
    {
        $integration = IntegrationModel::createIfNotExistAndReturn([
            'id' => static::$ID,
            'name' => get_called_class(),
            'code' => static::class,
        ]);
        return $integration->id;
    }
    
    public static function registerAll()
    {
        $realPath = __DIR__.'/';
        
        collect(scandir($realPath))
            ->each(function ($item) use ($realPath) {
                if (in_array($item, ['.', '..'])) return;
                dd($realPath . $item, __NAMESPACE__);
                if (is_dir($realPath . $item)) {
                    $modelName = $item;
                    IntegrationModel::createIfNotExistAndReturn([
                        'id' => $id,
                        'name' => get_called_class(),
                        'code' => static::class,
                    ]);
                }

                if (is_file($realPath . $item)) {
                    Log::warning('Não deveria ter aquivo nessa pasta');         
                }
            });
    }

}

<?php

namespace Siravel\Services\System;

use Siravel\Models\User;
// use Siravel\Models\Order;
use Siravel\Jobs\RoutineOrganizerCreateJob;
use Population\Models\Identity\Actors\Business;
use Illuminate\Support\Facades\Config;
use Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Request;
use Facilitador\Models\Setting;
use Exception;

class BusinessService extends Service
{
    private $business = false;
    public $features = [];

    public function __construct()
    {
        $this->loadBusiness();
    }

    // Ignora as urls mencionadas
    public static $IGNORE_URLS = [
        '',
        '/',
        'login'
    ];

    // Ignora as urls que começam com
    public static $IGNORE_PARTIAL_URLS = [
        'admin',
        'services',
        'assets',
        'horizon',
        'vendor'
    ];

    // Urls Bloqueadas
    public static $BLOCK_PARTIAL_URLS = [
        'cgi-bin/webcm',
    ];

    /**
     * Identifica o negócio da empresa de acordo com o token secreto
     */
    public static function getBusinessUser()
    {
        //@todo Mudar
        if (\App::runningInConsole() ) {
            Log::notice('Rodando em Console');
            return null;
        }
        $business = self::getViaParamsToken();

        if (!$business && self::isBlockUrl()) {
            return abort(403);
        }

        return $business;
    }


    public static function isBlockUrl()
    {
        if (in_array(Request::path(), self::$IGNORE_URLS)) {
            return null;
        }
        if (!empty(self::$BLOCK_PARTIAL_URLS)) {
            foreach(self::$BLOCK_PARTIAL_URLS as $value) {
                // Verifica se a url começa com o path mencionado
                if (substr(Request::path(), 0, strlen($value))==$value) {
                    return true;
                }
            }
        }
        return false; 
    }


    /**
     * Identifica o negócio da empresa de acordo com o token secreto
     */
    public static function getViaParamsToken()
    {
        if(!empty($_SERVER['HTTP_BUSINESS_TOKEN'])) {
        
            // Log::info(
            //     '[Aleluia] Consegui usar business' . print_r($_GET, true) . print_r($_POST, true)
            //     . print_r($_SERVER, true)
            // );
            return User::where('token', $_SERVER['HTTP_BUSINESS_TOKEN'])->first();
        }
        
        if(!empty($_POST['business_token'])) {
        
            // Log::info(
            //     '[Aleluia] Consegui usar business' . print_r($_GET, true) . print_r($_POST, true)
            //     . print_r($_SERVER, true)
            // );
            return User::where('token', $_POST['business_token'])->first();
        }
        
        if(!empty($_POST['BUSINESS_TOKEN'])) {
        
            // Log::info(
            //     '[Aleluia] Consegui usar business' . print_r($_GET, true) . print_r($_POST, true)
            //     . print_r($_SERVER, true)
            // );
            return User::where('token', $_POST['BUSINESS_TOKEN'])->first();
        }
        
        if(!empty($_GET['business_token'])) {
        
            // Log::info(
            //     '[Aleluia] Consegui usar business' . print_r($_GET, true) . print_r($_POST, true)
            //     . print_r($_SERVER, true)
            // );
            return User::where('token', $_GET['business_token'])->first();
        }
        
        if(!empty($_GET['BUSINESS_TOKEN'])) {
        
            // Log::info(
            //     '[Aleluia] Consegui usar business' . print_r($_GET, true) . print_r($_POST, true)
            //     . print_r($_SERVER, true)
            // );
            return User::where('token', $_GET['BUSINESS_TOKEN'])->first();
        }

        return null;
        //return User::where('token', \Illuminate\Support\Facades\Config::get('business.default'))->first();
        // bilo -> 3a0cafad9715806584cf60bf6c04200a
        // Passepague -> \Illuminate\Support\Facades\Config::get('business.default')
    }

    // /**
    //  * Cria base de Organizações clientes do negócio da empresa
    //  * em cima dos tokens públicos enviados pelos apps.
    //  */
    // public static function createIfNotExist(Order $order)
    // {
    //     if (empty($order->company_token)) {
    //         return true;
    //     }

    //     if ($found = User::where('token_public', $order->company_token)->first()){
    //         return true;
    //     }

    //     return RoutineOrganizerCreateJob::dispatch($order->user, $order->company_token);
    // }

    /**
     * Retorna Serviço de acordo com o Usuario
     */
    public static function getBusinessServiceForUser(User $businessUser, $companyToken = false)
    {
        if (empty($businessUser->business) || empty($businessUser->businessUrl)) {
            Log::notice('Business não configurado para usuário de negócio: '.$businessUser->id);
            return false;
        }

        $class = "\\App\\Integrations\\Business\\".$businessUser->business;
        return new $class($businessUser->businessUrl, $companyToken, $businessUser->token);
    }

    public function hasBusiness()
    {
        return $this->business ? true : false;
    }

    public function isHability()
    {
        $config = \Illuminate\Support\Facades\Config::get('sitec-tools.configs.multi-tenant', true);
        if (!$config) {
            return false;
        }
        return true;
    }


    /**
     * Faz o business padrão voltar a ser o original do sistema
     *
     * @return void
     */
    public function clearDefault()
    {
        CacheService::clearUniversal('business-default');
        return true;
    }

    /**
     * Transforma no Business padrão do Sistema
     *
     * @return void
     */
    public function makeDefault(Business $business)
    {
        if (!$this->isHability()) {
            return false;
        }
        CacheService::setUniversal('business-default', $business->code);
        $this->business = $business;
        return true;
    }

    public function isDefault(Business $business)
    {
        if (!$this->isHability()) {
            return false;
        }
        return $business->code === $this->getBusiness()->code;
    }

    public function userAsColaborator(User $user)
    {
        // @todo Fazer 
        return true;
    }

    public function hasFeature(string $key)
    {
        if (!empty($this->features)) {
            foreach ($this->features as $feature) {
                if ($feature->code === $key) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getCode()
    {
        if (!$this->hasBusiness() && !$this->loadBusiness()) {
            throw new Exception('Não detectado o business');
        }
        return $this->getBusiness()->code;
    }

    public function getBusiness()
    {
        return $this->business;
    }

    public function userHasPermission($user)
    {
        
    }



    private function loadBusiness()
    {
        if (!VersionService::isInstall()) {
            return false;
            // throw new Exception('Não está instalado o siravel');
        }
        if (!$this->business = $this->detectedBusiness()) {
            return false;
            // throw new Exception('Não detectado o business');
        }

        if (Schema::hasTable('settings')) {
            // Get Settings
            Setting::all()->each(
                function ($item) {
                    Log::debug('[Negocio] Setting Configurado:'. print_r($item->getAppAtribute('config'), true). print_r($item->value, true));
                    if (!empty($item->getAppAtribute('config'))) {
                        Config::set($item->getAppAtribute('config'), $item->value);
                    }
                }
            );
        }

        if ($this->business->features) {
            $this->features = $this->business->features->all();
        }
        return true;
    }

    private function detectedBusiness()
    {
        // @todo
        // if (!$this->isHability()) {
        //     return false;
        // }
        $domainSlug = \SiUtils\Helper\General::getSlugForUrl(Request::root());

        /**
         * Localhost ou terminal, retorna o padrao
         */
        if ($domainSlug == 'localhost' || app()->runningInConsole()) {
            return $this->getDefault();
        }

        if (!$business = \Population\Models\Identity\Actors\Business::where('code', $domainSlug)->first()) {
            // return $this->getDefault(); // @todo
            return false;
        }
        return $business;
    }

    private function getDefault()
    {
        if (!$this->isHability()) {
            return false;
        }

        if (!$default = CacheService::getUniversal('business-default')) {
            $default = 'HotelByNow';
        }
        if (!$business = \Population\Models\Identity\Actors\Business::where('code', $default)->first()) {
            return false;
        }
        return $business;
    }
}

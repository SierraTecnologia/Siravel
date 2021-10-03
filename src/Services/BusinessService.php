<?php

namespace Siravel\Services;

use Exception;
// use Siravel\Models\Order;
use Facilitador\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Log;
use Siravel\Jobs\RoutineOrganizerCreateJob;
use Siravel\Models\Negocios\Business;
use Siravel\Models\User;

class BusinessService
{
    private $business = false;
    public $features = [];
    public $run = 0;
    public $log = false;

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
    
    public function __construct()
    {
        $this->log = new \Muleta\Services\LoggerService('Business');
        $this->loadBusiness();
        // $this->loadSettings();
    }

    /**
     * @return null|static
     */
    public function loadSettings()
    {
        if ($this->business) {
            \Website::setNegocio($this->business->code);
            if (Schema::hasTable('settings')) {
                // Get Settings
                $this->business->settings()->each(
                    function ($item) {
                        if (!empty($item->getAppAtribute('config'))) {
                            $eachConfig = explode('|', $item->getAppAtribute('config'));
                            $this->log->addLogger('[Negocio] Setting Configurado:'. print_r($item->getAppAtribute('config'), true). print_r($item->value, true));
                            foreach ($eachConfig as $replaceForConfig) {
                                Config::set($replaceForConfig, $item->value);
                            }
                        }
                    }
                );

                Config::set('adminlte.logo_img', \Website::getAsset('logo.png'));

                if ($websiteData = $this->business->datas()->where('code', 'website')->first()) {
                    \Website::setData($websiteData->value);
                }

                return $this;
            }
        }
    }

    /**
     * @return false
     */
    public function userAsSubscript($user): bool
    {
        // @todo Fazer
        return false;
    }


    public static function isBlockUrl(): ?bool
    {
        if (in_array(Request::path(), self::$IGNORE_URLS)) {
            return null;
        }
        if (!empty(self::$BLOCK_PARTIAL_URLS)) {
            foreach (self::$BLOCK_PARTIAL_URLS as $value) {
                // Verifica se a url começa com o path mencionado
                if (substr(Request::path(), 0, strlen($value))==$value) {
                    return true;
                }
            }
        }
        return false;
    }



    public function hasBusiness(): bool
    {
        return $this->business ? true : false;
    }



    /**
     * @return true
     */
    public function userAsColaborator(User $user): bool
    {
        // @todo Fazer
        return true;
    }

    public function hasFeature(string $key): bool
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

    public function userHasPermission($user): void
    {
    }

    private function loadBusiness(): bool
    {
        if (!VersionService::isInstall()) {
            return false;
            // throw new Exception('Não está instalado o siravel');
        }
        if (!$this->business = $this->detectedBusiness()) {
            return false;
            // throw new Exception('Não detectado o business');
        }
        
        if ($this->business->features) {
            $this->features = $this->business->features->all();
        }
        return true;
    }

    private function detectedBusiness()
    {
        $domainSlug = \SiUtils\Helper\General::getSlugForUrl(Request::root());
        if ($this->isToIgnore() && $domainSlug !== 'localhost') {
            $this->log->addLogger('[Negocio] IsToIgnore, Slug: '. $domainSlug);
            return false;
        }

        if ($business = $this->isSwitchToBusiness()) {
            return $business;
        }

        if ($this->isToForced()) {
            return $this->getForced();
        }
        
        if ($business = Business::where('code', $domainSlug)->first()) {
            $this->log->addLogger('[Negocio] Detectado Business por Dominio:'. print_r($business->code, true));
            return $business;
        }
        /**
         * Localhost ou terminal, retorna o padrao
         */
        if ($domainSlug == 'localhost'/* || config('app.debug')*/) {
            $this->log->addLogger('[Negocio] Usando default: '. config('siravel.default', 'ricasolucoes'));
            return Business::where('code', config('siravel.default', 'ricasolucoes'))->first();
        }

        return false;
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
     *
     * @return false|object
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

    /**
     * Identifica o negócio da empresa de acordo com o token secreto
     */
    public static function getBusinessUser()
    {
        //@todo Mudar
        if ($this->isToIgnore()) {
            Log::notice('Rodando em Console');
            return null;
        }
        $business = self::getViaParamsToken();

        if (!$business && self::isBlockUrl()) {
            return abort(403);
        }

        return $business;
    }
    /**
     * Faz o business padrão voltar a ser o original do sistema
     *
     * @return true
     */
    public function clearDefault(): bool
    {
        CacheService::clearUniversal('business-console');
        CacheService::clearUniversal('business_switch');
        return true;
    }


    
    public function isToIgnore(): bool
    {
        if (!$this->isHability()) {
            return true;
        }

        return \App::runningInConsole() && !$this->isToForced();
    }
    public function isHability(): bool
    {
        $config = true; //\Illuminate\Support\Facades\Config::get('app.multi-tenant', true);
        if (!$config) {
            return false;
        }
        return true;
    }
    public function isActived(Business $business): bool
    {
        if ($this->isToIgnore()) {
            return false;
        }
        return $business->code === $this->getBusiness()->code;
    }

    private function isSwitchToBusiness()
    {
        if (!empty(Session::get('business_switch'))) {
            return Business::where('code', Session::get('business_switch'))->first();
        }

        if (!empty(CacheService::getUniversal('business_switch'))) {
            return Business::where('code', CacheService::getUniversal('business_switch'))->first();
        }

        return false;
    }

    private function isToForced(): bool
    {
        if (CacheService::getUniversal('business-console')) {
            return true;
        }
        return false;
    }
    private function getForced()
    {
        if ($this->isToIgnore()) {
            return false;
        }

        if (!$forced = CacheService::getUniversal('business-console')) {
            return false;
        }
        if (!$business = \Siravel\Models\Negocios\Business::where('code', $forced)->first()) {
            return false;
        }
        return $business;
    }

    /**
     * Transforma no Business padrão do Sistema (Para Usuário Somente)
     *
     * @return true
     */
    public function switchToBusiness(Business $business): bool
    {
        try {
            Session::put('business_switch', $business->code);
            CacheService::setUniversal('business_switch', $business->code);
            $this->business = $business;

            return true;
        } catch (Exception $e) {
            throw new Exception('Error switch to business', 1);
        }
    }
    public function forceBusiness(Business $business): bool
    {
        if (!$this->isHability()) {
            return false;
        }
        CacheService::setUniversal('business-console', $business->code);
        $this->business = $business;
        return true;
    }

    public function isToApplyCodeBusiness(Model $model): bool
    {
        if ($this->isToIgnore()) {
            return false;
        }
        return Schema::hasColumn($model->getTable(), 'business_code');
    }
}

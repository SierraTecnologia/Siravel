<?php
/**
 * 
 */

namespace SiSeed\Ideia\Scholl\Actions;

use Illuminate\Support\Facades\Log;

class Learn
{

    protected $allActions = [];

    public $cod = false;

    public $classAfetada = false;

    public $classAExecutar = false;

    public $type = false;

    /**
     * Ações para Investigar ou Explorar algo
     * Spider, Aranha, ou Explorer, Explorador
     */
    public static $spider = 1;

    /**
     * Ações de Rotinas - Periodicos
     * Ex: Backup, Ping nos Servidores
     */
    public static $routine = 2;

    /**
     * Ações que são emitidas como eventos engatilhados após determinadas ações em cima de Repositórios
     */
    public static $hook = 3;

    /**
     * Ações de importar conteudos dos tokens, jira, repositórios, etc.. 
     * Ou enviar informações do Boss para Esses Produtos. Ex: Workflow do jira, ou novos tickets!
     */
    public static $sync = 4;

    /**
     * Verifica latencia e serviços se estão tudo em Order e Funcionando
     */
    public static $life = 5;

    public function __construct($cod, $classAfetada, $classAExecutar, $type)
    {
        $this->cod = $cod;
        $this->classAfetada = $classAfetada;
        $this->classAExecutar = $classAExecutar;
        $this->type = $type;
    }

    public function getClassWithParams($instance)
    {
        $classAExecutar = '\\'.$this->classAExecutar;
        if (!$instance instanceof $this->classAfetada) {
            Log::notice('Não é instancia de '. $this->classAfetada.'!');
            return abort(500, 'Não é instancia de!');
        }
        return new $classAExecutar($instance);
    }

    /**
     * FUncoes para os Controllers Internos
     */
    public static function getModels()
    {
        $actions = self::loadActions();
        $models = [];
        foreach ($actions as $action)
        {
            if (!in_array($action->classAfetada, $models)) {
                $models[] = $action->classAfetada;
            }
        }
        return $models;
    }

    

    /**
     * FUncoes para os Controllers Internos
     */
    public static function getOnlyActionsForModel($model)
    {
        $actions = self::loadActions();
        $onlyModelActions = [];
        foreach ($actions as $action)
        {
            if ($model == $action->classAfetada) {
                $onlyModelActions[] = $action;
            }
        }
        return $onlyModelActions;
    }


    /**
     * Funções GErais
     */
    protected static function loadActions()
    {
        return self::getSyncs(self::getHooks(self::getRoutines(self::getSpiders())));
    }

    public static function getActionByCode($cod)
    {
        $actions = self::loadActions();
        foreach($actions as $action) {
            if($action->cod == $cod) {
                return $action;
            }
        }
        return false;
    }
    
    protected static function getSpiders($actions = [])
    {
        /**
         * Scaneia paginas de determinado Website
         */
        $actions[] = self::insertAction(
            'scanDomain',
            \Siravel\Models\Components\Infra\Domain::class, // Ou Url
            \SiInteraction\Actions\Worker\Explorer\Spider::class,
            self::$spider
        );

        /**
         * Scaneia paginas de determinado Website
         */
        $actions[] = self::insertAction(
            'whoisDomain',
            \Siravel\Models\Components\Infra\Domain::class, // Ou Url
            \SiInteraction\Actions\Worker\Explorer\Whois::class,
            self::$spider
        );

        return $actions;
    }
    
    protected static function getRoutines($actions = [])
    {
        /**
         * Backup dos 
         */
        $actions[] = self::insertAction(
            'backupDatabase',
            \Siravel\Models\Components\Infra\DatabaseCollection::class,
            \SiInteraction\Actions\Worker\Sync\Keys\BackupCollection::class,
            self::$routine
        );

        /**
         * Procura por arquivos de Log dentro das Maquinas
         */
        $actions[] = self::insertAction(
            'searchLog',
            \Siravel\Models\Components\Infra\Computer::class,
            \SiInteraction\Actions\Worker\Logging\Logging::class,
            self::$routine
        );

        return $actions;
    }

    protected static function getHooks($actions = [])
    {

        /**
         * Analisa a qualidade de código nos Projects Atuais
         */
        $actions[] = self::insertAction(
            'analyseComit',
            \Siravel\Models\Components\Code\Commit::class,
            \SiInteraction\Actions\Worker\Analyser\Analyser::class,
            self::$hook
        );

        /**
         * Atualiza as Maquinas de Staging e Produção
         */
        $actions[] = self::insertAction(
            'deployCommit',
            \Siravel\Models\Components\Code\Commit::class,
            \SiInteraction\Actions\Worker\Deploy\Deploy::class,
            self::$hook
        );

        return $actions;
    }


    protected static function getSyncs($actions = [])
    {

        $actions[] = self::insertAction(
            'importIntegrationToken',
            \Siravel\Models\Components\Integrations\Token::class,
            \SiInteraction\Actions\Worker\Sync\Keys\ImportFromToken::class,
            self::$routine
        );

        /**
         * Analisa a qualidade de código nos Projects Atuais
         */
        $actions[] = self::insertAction(
            'syncProject',
            \Siravel\Models\Components\Code\Project::class,
            \SiInteraction\Actions\Worker\Sync\Project::class,
            self::$hook
        );

        return $actions;

    }

    protected static function insertAction($cod, $classAfetada, $classAExecutar, $type)
    {
        $newAction = new self($cod, $classAfetada, $classAExecutar, $type);
        return $newAction;
    }

    /**
     * Se byClass nao for false, retorna todas as ações para qualquer tipo de instancia
     */
    public function getActions($byClass = false)
    {
        if (empty($this->allActions)) {
            $this->allActions = self::loadActions();
        }
        return $this->allActions;
    }

}

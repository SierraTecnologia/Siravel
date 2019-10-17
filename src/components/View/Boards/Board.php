<?php
/**
 * 
 */

namespace SiInteractions\View\Boards;

use Illuminate\Support\Facades\Log;

class Board
{

    protected $allBoards = [];

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
        $Boards = self::loadBoards();
        $models = [];
        foreach ($Boards as $Board)
        {
            if (!in_array($Board->classAfetada, $models)) {
                $models[] = $Board->classAfetada;
            }
        }
        return $models;
    }

    

    /**
     * FUncoes para os Controllers Internos
     */
    public static function getOnlyBoardsForModel($model)
    {
        $Boards = self::loadBoards();
        $onlyModelBoards = [];
        foreach ($Boards as $Board)
        {
            if ($model == $Board->classAfetada) {
                $onlyModelBoards[] = $Board;
            }
        }
        return $onlyModelBoards;
    }


    /**
     * Funções GErais
     */
    protected static function loadBoards()
    {
        return self::getSyncs(self::getHooks(self::getRoutines(self::getSpiders())));
    }

    public static function getBoardByCode($cod)
    {
        $Boards = self::loadBoards();
        foreach($Boards as $Board) {
            if($Board->cod == $cod) {
                return $Board;
            }
        }
        return false;
    }
    
    protected static function getSpiders($Boards = [])
    {
        /**
         * Scaneia paginas de determinado Website
         */
        $Boards[] = self::insertBoard(
            'scanDomain',
            \Siravel\Models\Components\Infra\Domain::class, // Ou Url
            \App\Boards\Worker\Explorer\Spider::class,
            self::$spider
        );

        /**
         * Scaneia paginas de determinado Website
         */
        $Boards[] = self::insertBoard(
            'whoisDomain',
            \Siravel\Models\Components\Infra\Domain::class, // Ou Url
            \App\Boards\Worker\Explorer\Whois::class,
            self::$spider
        );

        return $Boards;
    }
    
    protected static function getRoutines($Boards = [])
    {
        /**
         * Backup dos 
         */
        $Boards[] = self::insertBoard(
            'backupDatabase',
            \Siravel\Models\Components\Infra\DatabaseCollection::class,
            \App\Boards\Worker\Sync\Keys\BackupCollection::class,
            self::$routine
        );

        /**
         * Procura por arquivos de Log dentro das Maquinas
         */
        $Boards[] = self::insertBoard(
            'searchLog',
            \Siravel\Models\Components\Infra\Computer::class,
            \App\Boards\Worker\Logging\Logging::class,
            self::$routine
        );

        return $Boards;
    }

    protected static function getHooks($Boards = [])
    {

        /**
         * Analisa a qualidade de código nos Projects Atuais
         */
        $Boards[] = self::insertBoard(
            'analyseComit',
            \Siravel\Models\Components\Code\Commit::class,
            \App\Boards\Worker\Analyser\Analyser::class,
            self::$hook
        );

        /**
         * Atualiza as Maquinas de Staging e Produção
         */
        $Boards[] = self::insertBoard(
            'deployCommit',
            \Siravel\Models\Components\Code\Commit::class,
            \App\Boards\Worker\Deploy\Deploy::class,
            self::$hook
        );

        return $Boards;
    }


    protected static function getSyncs($Boards = [])
    {

        $Boards[] = self::insertBoard(
            'importIntegrationToken',
            \Siravel\Models\Components\Integrations\Token::class,
            \App\Boards\Worker\Sync\Keys\ImportFromToken::class,
            self::$routine
        );

        /**
         * Analisa a qualidade de código nos Projects Atuais
         */
        $Boards[] = self::insertBoard(
            'syncProject',
            \Siravel\Models\Components\Code\Project::class,
            \App\Boards\Worker\Sync\Project::class,
            self::$hook
        );

        return $Boards;

    }

    protected static function insertBoard($cod, $classAfetada, $classAExecutar, $type)
    {
        $newBoard = new self($cod, $classAfetada, $classAExecutar, $type);
        return $newBoard;
    }

    /**
     * Se byClass nao for false, retorna todas as ações para qualquer tipo de instancia
     */
    public function getBoards($byClass = false)
    {
        if (empty($this->allBoards)) {
            $this->allBoards = self::loadBoards();
        }
        return $this->allBoards;
    }

}
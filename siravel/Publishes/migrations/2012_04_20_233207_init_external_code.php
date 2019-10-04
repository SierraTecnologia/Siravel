<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Logic\ComponentsNavegador;
use App\Logic\ComponentsDirectory;

class InitExternalCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // return true;

        $databases = [
            'almanac',
            'application',
            'audit',
            'auth',
            'calendar',
            'cache',
            'config',
            'countdown',
            'conduit',
            'conpherence',
            'chatlog',
            'daemon',
            'badges',
            'dashboard',
            'differential',
            'diviner',
            'draft',
            'drydock',
            'doorkeeper',
            'file',
            'flag',
            'feed',
            'fact',
            'fund',
            'legalpad',
            'herald',
            'metamta',
            'meta_data',
            'maniphest',
            'multimeter',
            'nuance',
            'harbormaster',
            'packages',
            'project',
            'policy',
            'pholio',
            'phortune',
            'phriction',
            'phurl',
            'passphrase',
            'phragment',
            'pastebin',
            'phame',
            'ponder',
            'phlux',
            'phrequent',
            'repository',
            'releeph',
            'search',
            'slowvote',
            'spaces',
            'system',
            'timeline',
            'token',
            'worker',
            'oauth_server',
            'owners',
            'user',
            'xhpast',
            'xhprof',
            'xhpastview'
        ];

        $mysql = file_get_contents(base_path('libs').'/playground/resources/sql/quickstart.sql');

        $mysql = str_replace('{$CHARSET}', 'UTF8', $mysql);
        $mysql = str_replace('{$CHARSET_TEXT}', 'UTF8', $mysql);
        $mysql = str_replace('{$CHARSET_SORT}', 'UTF8', $mysql);
        $mysql = str_replace('{$CHARSET_FULLTEXT}', 'UTF8', $mysql);

        $mysql = str_replace('{$COLLATE}', 'utf8_general_ci', $mysql);
        $mysql = str_replace('{$COLLATE_TEXT}', 'utf8_general_ci', $mysql);
        $mysql = str_replace('{$COLLATE_SORT}', 'utf8_general_ci', $mysql);
        $mysql = str_replace('{$COLLATE_FULLTEXT}', 'utf8_general_ci', $mysql);

        foreach ($databases as $database) {
            $mysql = str_replace('{$NAMESPACE}_'.$database.'.', '', $mysql); //env('DB_DATABASE', 'boss')
            $mysql = str_replace('`{$NAMESPACE}_'.$database.'`.', '', $mysql); //env('DB_DATABASE', 'boss')
            $mysql = str_replace('CREATE DATABASE /*!32312 IF NOT EXISTS*/ `{$NAMESPACE}_'.$database.'` /*!40100 DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_ci */;', '', $mysql);
            $mysql = str_replace('USE `{$NAMESPACE}_'.$database.'`;', '', $mysql);
            $mysql = str_replace('ALTER DATABASE `{$NAMESPACE}_'.$database.'` COLLATE utf8_general_ci;', '', $mysql);
        }

        //Tabelas que Repetem - 3 tabelas edge, edge_data, lisk_counter
        $mysql = str_replace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $mysql);
        // $mysql = str_replace('CREATE TABLE `edge', 'CREATE TABLE IF NOT EXISTS `edge', $mysql);
        // $mysql = str_replace('CREATE TABLE `isk_counter', 'CREATE TABLE IF NOT EXISTS `lisk_counter', $mysql);

        // Retira Desnecessario
        $mysql = str_replace('SET NAMES utf8 ;', '', $mysql);
        $mysql = str_replace('SET character_set_client = UTF8 ;', '{CORTAR}', $mysql);

        

        // DB::unprepared($mysql); // COmentei pq nao pegava o arquivo todo
        $mysqlCode = explode('{CORTAR}', $mysql);
        foreach ($mysqlCode as $mysql) {
            $mysql = trim($mysql);
            if (!empty($mysql)) {
                var_dump('[Logic Migration] Criando table: '.$mysql);
                DB::connection()->getPdo()->exec($mysql);
            }
        }
        
        return true;

        // patches
        // autopatches
        $mysqlfunction = function ($mysql) use ($databases) {
            $mysql = str_replace('{$CHARSET}', 'UTF8', $mysql);

            foreach ($databases as $database) {
                $mysql = str_replace('{$NAMESPACE}_'.$database.'.', '', $mysql); //env('DB_DATABASE', 'boss')
                $mysql = str_replace('`{$NAMESPACE}_'.$database.'`.', '', $mysql); //env('DB_DATABASE', 'boss')
                $mysql = str_replace('USE `{$NAMESPACE}_'.$database.'`;', '', $mysql);
                $mysql = str_replace('ALTER DATABASE `{$NAMESPACE}_'.$database.'` COLLATE utf8_general_ci;', '', $mysql);
            }

            $mysql = str_replace('{$COLLATE_TEXT}', 'utf8_general_ci', $mysql);

            var_dump($mysql);
            DB::connection()->getPdo()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
            // DB::unprepared($mysql);
            DB::connection()->getPdo()->exec($mysql);
        };

        // (new Navegador())->executeAPartirDe('daemonstatus.sql',
        //     [
        //         (new Directory(base_path('libs').'/playground/resources/sql/patches/')),
        //         // (new Directory(base_path('libs').'/playground/resources/sql/autopatches/'))
        //     ],
        //     $mysqlfunction,
        //     [
        //         // Ignore Files
        //         '033.privtest.sql',
        //         '037.setuptest.sql',
        //         '.php',
        //         '120.noop.sql'
        //     ]
        // );

        (new Navegador())->executeForEachContentForManyDirs(
            [
                (new Directory(base_path('libs').'/playground/resources/sql/patches/')),
                (new Directory(base_path('libs').'/playground/resources/sql/autopatches/'))
            ],
            $mysqlfunction,
            [
                // Ignore Files
                '033.privtest.sql',
                '037.setuptest.sql',
                '.php',
                '120.noop.sql'
            ]
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}

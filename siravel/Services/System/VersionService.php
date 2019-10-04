<?php

namespace Siravel\Services\System;

use Illuminate\Support\Facades\Config;

class VersionService extends Service
{
    public function getReleases()
    {
        $input = new \ChangeLog\IO\File([
            'file' => base_path('CHANGELOG.md')
        ]);
        
        $parser = new \ChangeLog\Parser\KeepAChangeLog();
        
        $cl = new \ChangeLog\ChangeLog;
        $cl->setParser($parser);
        $cl->setInput($input);
        
        $log = $cl->parse();
        
        // Instance of ChangeLog\Log
        return $log->getReleases();
    }

    /**
     * Retorna se o sistema está instalado ou não
     *
     * @return boolean
     */
    public static function isInstall()
    {
        return \Schema::hasTable('businesses');
    }
}

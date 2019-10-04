<?php
/**
 * 
 */

namespace App\Logic\Actions\Worker\Sync\Keys;

use App\Logic\Tools\Databases\Mysql\Mysql as MysqlTool;
use App\Models\Integrations\Token;
use App\Logic\Connections\Integrations\Sentry\Sentry;
use App\Logic\Connections\Integrations\Jira\Jira;
use Illuminate\Support\Facades\Log;

class ImportFromToken
{

    protected $token = false;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function execute()
    {
        Log::info('Tratando Token .. '.print_r($this->token, true));
        if ($this->token->integration_service_id == Sentry::$ID) {
            // (new \App\Logic\Connections\Integrations\Sentry\Import($this->token))->bundle();
        } else if ($this->token->integration_service_id == Jira::$ID) {
            (new \App\Logic\Connections\Integrations\Jira\Import($this->token))->bundle();
        }
    }
}

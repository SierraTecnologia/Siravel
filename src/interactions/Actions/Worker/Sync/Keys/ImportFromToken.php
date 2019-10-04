<?php
/**
 * 
 */

namespace SiInteractions\Logic\Actions\Worker\Sync\Keys;

use App\Logic\Tools\Databases\Mysql\Mysql as MysqlTool;
use App\Models\Integrations\Token;
use SiWeapons\Integrations\Sentry\Sentry;
use SiWeapons\Integrations\Jira\Jira;
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
            // (new \SiWeapons\Integrations\Sentry\Import($this->token))->bundle();
        } else if ($this->token->integration_service_id == Jira::$ID) {
            (new \SiWeapons\Integrations\Jira\Import($this->token))->bundle();
        }
    }
}

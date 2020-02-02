<?php
/**
 * 
 */

namespace SiInteractions\Worker\Sync\Keys;

use SiUtils\Tools\Databases\Mysql\Mysql as MysqlTool;
use Population\Models\Components\Integrations\Token;
use SiWeapons\Integrations\Sentry\Sentry;
use SiWeapons\Integrations\Jira\Jira;
use SiWeapons\Integrations\Gitlab\Gitlab;
use Log;

class ImportFromToken
{

    protected $token = false;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function execute()
    {
        if (!$this->token->account->status) {
            return false;
        }
        Log::info('Tratando Token .. '.print_r($this->token, true));

        if ($this->token->account->integration_id == Sentry::getCodeForPrimaryKey()) {
            // (new \SiWeapons\Integrations\Sentry\Import($this->token))->bundle();
        } else if ($this->token->account->integration_id == Jira::getCodeForPrimaryKey()) {
            (new \SiWeapons\Integrations\Jira\Import($this->token))->bundle();
        } else if ($this->token->account->integration_id == Gitlab::getCodeForPrimaryKey()) {
            (new \SiWeapons\Integrations\Gitlab\Import($this->token))->bundle();
        }

        return true;
    }
}

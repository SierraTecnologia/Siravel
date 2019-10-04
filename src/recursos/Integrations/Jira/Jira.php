<?php
/**
 * https://github.com/lesstif/php-jira-rest-client
 */

namespace SiWeapons\Integrations\Jira;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Integration;
use JiraRestApi\Configuration\ArrayConfiguration;

class Jira extends Integration
{
    public static $ID = 4;

    public $registersForPage = 10;

    protected function getConnection($token = false)
    {
        return $this;
    }

    protected function getPaginate($page = 1)
    {
        return [
            'startAt' => (($this->registersForPage*$page)-$this->registersForPage),
            'maxResults' => $this->registersForPage,
            // 'orderBy' => 'name',
            //'expand' => null,
        ];
    }

    protected function getConfig($token)
    {
        return new ArrayConfiguration(
            array(
                 'jiraHost' => 'https://getbilo.atlassian.net',
                 // for basic authorization:
                 'jiraUser' => $token->account,
                 'jiraPassword' => $token->token,
                 // to enable session cookie authorization (with basic authorization only)
                //  'cookieAuthEnabled' => true,
                //  'cookieFile' => storage_path('jira-cookie.txt'),
                //  // if you are behind a proxy, add proxy settings
                //  "proxyServer" => 'your-proxy-server',
                //  "proxyPort" => 'proxy-port',
                //  "proxyUser" => 'proxy-username',
                //  "proxyPassword" => 'proxy-password',
            )
        );
    }
}

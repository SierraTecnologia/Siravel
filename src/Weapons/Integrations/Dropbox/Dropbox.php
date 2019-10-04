<?php

namespace App\Logic\Connections\Integrations\Dropbox;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Dropbox
{

    public static $ID = 1;

    public $debug = true;
    public $truncatedDebug = false;
    
    public function __construct()
    {
        
    }

    public function getConnection()
    {
        return $this->login();
    }

    public function getToken()
    {
        $dropbox = new \MetzWeb\Dropbox\Dropbox(array(
            'apiKey'      => 'YOUR_APP_KEY',
            'apiSecret'   => 'YOUR_APP_SECRET',
            'apiCallback' => 'YOUR_APP_CALLBACK'
          ));

          $token = 'USER_ACCESS_TOKEN';
          $dropbox->setAccessToken($token);
          return $dropbox;
    }

    public function getUsername()
    {
        return env('dropboxusername');
    }

    public function getPassword()
    {
        return env('dropboxpassword');
    }

    public function login()
    {
        $ig = new \DropboxAPI\Dropbox($this->debug, $this->truncatedDebug);
        try {
            $ig->login($this->getUsername(), $this->getPassword());
        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
        return $ig;
    }

    public function getNewDataForComponent($component)
    {

    }

}

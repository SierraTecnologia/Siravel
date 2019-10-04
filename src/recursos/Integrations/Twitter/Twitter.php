<?php

namespace SiWeapons\Integrations\Twitter;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Twitter
{

    public static $ID = 6;

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
        $instagram = new \MetzWeb\Twitter\Twitter(array(
            'apiKey'      => 'YOUR_APP_KEY',
            'apiSecret'   => 'YOUR_APP_SECRET',
            'apiCallback' => 'YOUR_APP_CALLBACK'
          ));

          $token = 'USER_ACCESS_TOKEN';
          $instagram->setAccessToken($token);
          return $instagram;
    }

    public function getUsername()
    {
        return env('instagramusername');
    }

    public function getPassword()
    {
        return env('instagrampassword');
    }

    public function login()
    {
        $ig = new \TwitterAPI\Twitter($this->debug, $this->truncatedDebug);
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

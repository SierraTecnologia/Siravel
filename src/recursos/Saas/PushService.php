<?php

namespace SiWeapons\Saas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PushService extends Service
{

    public function __construct()
    {
        $this->url = 'https://onesignal.com/api';
        $this->companyToken = false;
    }

    public function send($params)
    {
        Log::info('[Onesignal] Enviando data: '. print_r($params, true));
        $response = $this->postWithAuthentication(
            'v1/notifications',
            $params,
            'NTViNjJiYjAtNDAyNy00NmM0LWJmNmUtYWI4OTRkODExMWUz'
        );
        Log::info('[Onesignal] Recebendo resposta: '. print_r($response, true));

        return true;
    }
    
}

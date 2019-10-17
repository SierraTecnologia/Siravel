<?php

namespace SiInteractions\Actions\Models\Accounts;

use Siravel\Models\Components\Code\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PhoneActivate;
use Illuminate\Support\Facades\Log;

class GetMedias implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Handle the user "dayling" event.
     * Every Day
     *
     * @param  \App\Models\Account  $account
     * @return void
     */
    public function dayling(Account $account)
    {
        if ($account->integration_id == \SiWeapons\Integrations\Instagram\Instagram::$ID) {
            (new GetMidias($account))->prepare($account->username)->execute();
        }

        return true;
    }
}
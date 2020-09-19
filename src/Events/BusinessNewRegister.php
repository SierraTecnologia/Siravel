<?php

namespace Siravel\Events;

use Siravel\Models\UserMeta;
use Illuminate\Queue\SerializesModels;

class BusinessNewRegister
{
    use SerializesModels;

    public $subscription;

    /**
     * Create a new event instance.
     *
     * @param  \Siravel\Models\UserMeta $subscription
     * @return void
     */
    public function __construct(UserMeta $subscription)
    {
        $this->subscription = $subscription;
    }
}
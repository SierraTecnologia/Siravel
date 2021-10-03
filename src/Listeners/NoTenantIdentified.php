<?php

namespace Siravel\Listeners;

use Tenancy\Identification\Events\NothingIdentified;

class NoTenantIdentified
{
    public function handle(NothingIdentified $event): void
    {
        abort(404);
    }
}

<?php

namespace SiWeapons\Integrations\SitecBoss;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Update extends SitecBoss
{
    public function organization(Organization $organization)
    {
        // Also simple to update any SitecBoss resource value
        $organization = $this->_connection->organizations->update(
            1,
            [
                'name' => 'Big Code'
            ]
        );
        var_dump($organization->getData());
    }
}

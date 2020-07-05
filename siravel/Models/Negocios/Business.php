<?php

namespace Siravel\Models\Negocios;

use Population\Models\Identity\Actors\Business as Model;

class Business extends Model
{
    /**
     * Retorna se é ou não o busines padrão
     *
     * @return boolean
     */
    public function isDefault()
    {
        return app(\Siravel\Services\System\BusinessService::class)->isDefault($this);
    }

}

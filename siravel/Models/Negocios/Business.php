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
        return \Siravel\Services\System\BusinessService::getSingleton()->isDefault($this);
    }

}

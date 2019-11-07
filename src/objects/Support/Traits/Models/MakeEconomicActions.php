<?php

namespace SiObjects\Support\Traits\Models;

use Illuminate\Support\Facades\Log;

trait MakeEconomicActions
{

    /**
     * Financeiro
     */
    public function banks()
    {
        return $this->morphToMany('Siravel\Models\Identity\Financeiro\Bank', 'bankable');
    }
    public function rendas()
    {
        return $this->morphMany('Siravel\Models\Identity\Financeiro\Renda', 'rendable');
    }
    public function gastos()
    {
        return $this->morphMany('Siravel\Models\Identity\Financeiro\Gasto', 'gastoable');
    }

    /**
     * Events
     */
    public static function bootMakeEconomicActions()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}

<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\Log;

trait MakeEconomicActions
{

    /**
     * Financeiro
     */
    public function banks()
    {
        return $this->morphToMany('App\Models\Identity\Financeiro\Bank', 'bankable');
    }
    public function rendas()
    {
        return $this->morphMany('App\Models\Identity\Financeiro\Renda', 'rendable');
    }
    public function gastos()
    {
        return $this->morphMany('App\Models\Identity\Financeiro\Gasto', 'gastoable');
    }

    /**
     * Events
     */
    protected static function bootMakeEconomicActions()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}

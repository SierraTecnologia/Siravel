<?php

namespace SiObjects\Support\Traits\Models;

use Illuminate\Support\Facades\Log;

trait AsFofocavel
{
    
    /**
     * One To Many (Polymorphic) - Feature FA
     *
     * @return void
     */

    public function infos()
    {
        return $this->morphMany('Siravel\Models\Entytys\Fisicos\Info', 'infoable');
    }
    /**
     * Many To Many (Polymorphic)
     */
    public function gostos()
    {
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Gosto', 'gostoable');
    }
    public function sitios()
    {
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Sitio', 'sitioable');
    }



    /**
     * Events
     */
    public static function bootAsFofocavel()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}

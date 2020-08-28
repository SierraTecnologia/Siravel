<?php

namespace Siravel\Models\Negocios;

use Telefonica\Models\Actors\Business as Model;
// use Facilitador\Models\Base as Model;

class Business extends Model
{

    /**
     * Get all of the features for the post.
     */
    public function features()
    {
        return $this->morphToMany('Siravel\Models\Feature', 'featureable');
    }

    // /**
    //  * Get all of the plugins for the post.
    //  */
    // public function plugins()
    // {
    //     return $this->morphToMany('App\Models\Plugin', 'pluginable');
    // }

    // /**
    //  * Get all of the widgets for the post.
    //  */
    // public function widgets()
    // {
    //     return $this->morphToMany('Siravel\Models\Negocios\Widget', 'widgetable');
    // }

    /**
     * Get all of the settings for the post.
     */
    public function settings()
    {
        return $this->hasMany('Facilitador\Models\Setting');
    }

    // /**
    //  * Get all of the subscriptions for the post.
    //  */
    // public function subscriptions()
    // {
    //     return $this->hasMany('Siravel\Models\Negocios\Subscription');
    // }

    /**
     * Retorna se é ou não o busines padrão
     *
     * @return boolean
     */
    public function isActived()
    {
        return app(\Siravel\Services\System\BusinessService::class)->isActived($this);
    }

}

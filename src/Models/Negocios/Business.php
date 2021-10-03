<?php

namespace Siravel\Models\Negocios;

use Telefonica\Models\Actors\Business as Model;

// use Facilitador\Models\Base as Model;

class Business extends Model
{

    public $table = 'businesses';
    /**
     * Get all of the features for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function features(): self
    {
        return $this->morphToMany('Siravel\Models\Feature', 'featureable')->withoutGlobalScopes();
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(): self
    {
        return $this->hasMany(\Facilitador\Models\Setting::class)->withoutGlobalScopes();
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
        return app(\Siravel\Services\BusinessService::class)->isActived($this);
    }
}

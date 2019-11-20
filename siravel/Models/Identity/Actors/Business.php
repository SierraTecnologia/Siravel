<?php

namespace Siravel\Models\Identity\Actors;

use Siravel\Models\Model;

class Business extends Model
{

    public $incrementing = false;
    protected $casts = [
        'code' => 'string',
    ];
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'language_code',
        'money_code',
        'user_id'
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'language_code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'money_code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
        
    /**
     * Get all of the owning businessable models.
     */
    public function businessable()
    {
        return $this->morphTo(); //, 'businessable_type', 'businessable_code'
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'businessable'); //, 'businessable_type', 'businessable_code');
    }


    /**
     * Get all of the features for the post.
     */
    public function features()
    {
        return $this->morphToMany('Siravel\Models\Features\Marketing\Feature', 'featureable');
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
    //     return $this->morphToMany('App\Models\Negocios\Widget', 'widgetable');
    // }

    /**
     * Get all of the settings for the post.
     */
    public function settings()
    {
        return $this->hasMany('Siravel\Models\System\Setting');
    }

    // /**
    //  * Get all of the subscriptions for the post.
    //  */
    // public function subscriptions()
    // {
    //     return $this->hasMany('App\Models\Negocios\Subscription');
    // }

    /**
     * Get all of the addresses for the post.
     */
    public function addresses()
    {
        return $this->morphToMany('Siravel\Models\Identity\Address', 'addresseable');
    }

    /**
     * Get all of the phones for the post.
     */
    public function phones()
    {
        return $this->morphToMany('Siravel\Models\Identity\Phone', 'phoneable');
    }

    /**
     * Get all of the post's accounts.
     */
    public function accounts()
    {
        return $this->morphMany('Siravel\Models\Identity\Digital\Account', 'accountable');
    }

    /**
     * Retorna se é ou não o busines padrão
     *
     * @return boolean
     */
    public function isDefault()
    {
        return \Siravel\Services\System\BusinessService::getSingleton()->isDefault($this);
    }



    /**
     * Outros Relatiosn Nad a aver
     *
     * @return void
     */

    public function sitios()
    {
        return $this->morphToMany('Siravel\Models\Identity\Digital\Sitio', 'sitioable');
    }
    /**
     * Get all of the skills for the post.
     */
    public function skills()
    {
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Skill', 'skillable');
    }
    public function infos()
    {
        return $this->morphMany('Siravel\Models\Market\Abouts\Info', 'infoable');
    }
    public function gostos()
    {
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Gosto', 'gostoable');
    }
    public function pircings()
    {
        return $this->morphToMany('Siravel\Models\Identity\Fisicos\Pircing', 'pircingable');
    }
    public function tatuages()
    {
        return $this->morphToMany('Siravel\Models\Identity\Fisicos\Tatuagem', 'tatuageable');
    }

}
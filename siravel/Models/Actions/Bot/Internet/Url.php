<?php

/**
 * This file is part of Gitonomy.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 * (c) Julien DIDIER <genzo.wm@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Siravel\Models\Actions\Bot\Internet;

use Siravel\Support\Traits\Models\ComplexRelationamentTrait;
use Siravel\Models\Model;

class Url extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'bot_internet_urls';     

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'infra_domain_id',
    ];

    public function linksFrom()
    {
        return $this->hasMany('Siravel\Models\Actions\Bot\Internet\UrlLink', 'from_bot_internet_url_id', 'id');
    }

    public function linksTo()
    {
        return $this->hasMany('Siravel\Models\Actions\Bot\Internet\UrlLink', 'to_bot_internet_url_id', 'id');
    }

    public function domain()
    {
        return $this->belongsTo('Siravel\Models\Components\Infra\Domain', 'infra_domain_id', 'id');
    }
}

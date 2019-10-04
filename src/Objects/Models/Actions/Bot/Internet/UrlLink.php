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

namespace App\Models\Bot\Internet;

use App\Models\Model;

class UrlLink extends Model
{
    protected $organizationPerspective = true;

    protected $table = 'bot_internet_url_links';     

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_bot_internet_url_id',
        'to_bot_internet_url_id',
    ];

    public function from()
    {
        return $this->belongsTo('App\Models\Bot\Internet\Url', 'from_bot_internet_url_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo('App\Models\Bot\Internet\Url', 'to_bot_internet_url_id', 'id');
    }
}

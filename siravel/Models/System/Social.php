<?php
namespace Siravel\Models\System;

use Siravel\Models\Model;

class Social extends Model {

    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
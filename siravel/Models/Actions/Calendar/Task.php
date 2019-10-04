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

namespace Siravel\Models\Actions\Calendar;

use Siravel\Models\Traits\ComplexRelationamentTrait;
use Siravel\Models\Model;

use Illuminate\Support\Facades\Log;

class Task extends Model
{
    use ComplexRelationamentTrait;

    protected $organizationPerspective = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'date_estimated',
        'done'
    ];


}

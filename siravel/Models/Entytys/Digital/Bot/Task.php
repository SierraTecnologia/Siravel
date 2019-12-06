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

namespace Informate\Models\Entytys\Digital\Bot;

use Informate\Traits\ComplexRelationamentTrait;
use Informate\Traits\TasksTrait;
use Informate\Models\Model;

class Task extends Model
{
    use ComplexRelationamentTrait, TasksTrait;

    protected $organizationPerspective = true;

    protected $table = 'bot_tasks';     

    protected static $COMPLEX_RELATIONAMENT_MODELS = [
        'model' => [
            \Informate\Models\Features\Qa\AnalyzerResult::class
        ]
    ];

    protected static $TASKS = [
        \App\Task\Analyzer\Analyzer::class
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'model_id',
        'progress',
        'action_code',
        'is_active'
    ];
}

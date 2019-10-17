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

namespace SiWeapons\Models\Digital\Bot;

use SiObjects\Support\Traits\Models\ComplexRelationamentTrait;
use Siravel\Models\Model;
use Siravel\Actions\Action;
use Illuminate\Support\Facades\Log;
class Runner extends Model
{
    use ComplexRelationamentTrait;

    protected $organizationPerspective = true;

    protected $table = 'bot_runners';

    protected $action = false;

    protected $target = false;

    protected $worker = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action_code',
        'target_id',
        'progress',
        'task',
        'stage'
    ];

    public function usingAction(Action $action)
    {
        $this->action = $action;
        return $this;
    }

    public function usingTarget(Model $target)
    {
        $this->target = $target;
        return $this;
    }

    public function prepare()
    {
        return $this;
    }

    /**
     * 
     */
    public function execute()
    {
        if (!is_null($this->id)){
            $this->save();
        }
        $this->worker = $this->action->getClassWithParams($this->target);
        $this->worker->execute();
        return $this;
    }

    public function run()
    {
        return $this->execute();
    }

}
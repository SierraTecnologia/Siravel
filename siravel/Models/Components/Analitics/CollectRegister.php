<?php
/**
 * Alguma ação que ocorra dentro da Produção
 */

namespace Siravel\Models\Components\Analitics;

use Siravel\Models\Model;

class CollectRegister extends Model
{

    protected $table = 'analitics_collect_registers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cenario',
        'alvo',
        'execute',
        'params',
        'before_scene_id',
    ];

}

<?php
/**
 * Sistemas de Analise de Crédito e Fraudes
 */

namespace Siravel\Models\Features\Statistics;

use Siravel\Models\Model;

class Statistic extends Model
{
    use ComplexRelationamentTrait;

    protected $organizationPerspective = true;

    protected $table = 'statistics';     

    protected static $COMPLEX_RELATIONAMENT_MODELS = [
        'model' => [
            \Siravel\Models\Entytys\Digital\Code\Commit::class
        ]
    ];


    /**
     * The attributes that are mass assignable.
     * 
     * Ex:
     * Table git effort --above 15 {src,lib}/*
     * File | n commits | active days
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'model_id',
        // Por Commit
        'ciclo',
        'description',
        'status',
    ];

    /**
     */
}
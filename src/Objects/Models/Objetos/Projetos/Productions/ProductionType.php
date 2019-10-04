<?php

namespace App\Models\Productions;

/**
 * Tipos de Produções
 */
use App\Models\Model;

class ProductionType extends Model
{

    protected $table = 'production_types';

    /**
     * Filmes
     *
     * @var array
     */
    public static $MOVIE = 1;

    /**
     * Jogos de Rpg
     *
     * @var array
     */
    public static $RPG = 2;

    /**
     * Seriados
     *
     * @var array
     */
    public static $SERIADOS = 3;

}
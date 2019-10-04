<?php

namespace SiObjects\Support\Traits\Models;

use Illuminate\Support\Facades\Log;

trait AsHuman
{
    use MakeEconomicActions;


        
    /**
     * Get all of the owning personable models.
     */
    public function personable()
    {
        return $this->morphTo(); //, 'personable_type', 'personable_code'
    }


    /**
     * Aparece em videos
     */
    public function videos()
    {
        return $this->morphedByMany('App\Models\Midia\Video', 'personable');
    }

    /**
     * Aparece em fotos
     */
    public function images()
    {
        return $this->morphedByMany('App\Models\Midia\Image', 'personable');
    }

    /**
     * Get all of the post's accounts.
     */
    public function accounts()
    {
        return $this->morphToMany('Siravel\Models\Identity\Account', 'accountable');
    }

    /**
     * Worker e Tarefas
     */
    public function workers()
    {
        return $this->morphMany('Siravel\Models\Identity\Rotina\Worker', 'workerable');
    }

    /**
     * Construtores
     */
    public function diario($date, $comment)
    {
        // @todo 
        return true;
    }



    /**
     * Many To Many (Polymorphic)
     */
    public function skills()
    {
        return $this->morphToMany('Siravel\Models\Identity\Hability\Skill', 'skillable');
    }
    public function gostos()
    {
        return $this->morphToMany('Siravel\Models\Identity\Hability\Gosto', 'gostoable');
    }
    public function sitios()
    {
        return $this->morphToMany('Siravel\Models\Identity\Hability\Sitio', 'sitioable');
    }
    public function itens()
    {
        return $this->morphToMany('Siravel\Models\Identity\Hability\Item', 'itemable');
    }
    public function productions()
    {
        return $this->morphToMany('App\Models\Components\Productions\Production', 'productionable');
    }
    
    /**
     * One To Many (Polymorphic) - Feature FA
     *
     * @return void
     */
    public function infos()
    {
        return $this->morphMany('Siravel\Models\Identity\Hability\Info', 'infoable');
    }
    public function pircings()
    {
        return $this->morphMany('Siravel\Models\Identity\Hability\Pircing', 'pircingable');
    }
    public function pintinhas()
    {
        return $this->morphMany('Siravel\Models\Identity\Hability\Pintinha', 'pintinhable');
    }
    public function tatuages()
    {
        return $this->morphMany('Siravel\Models\Identity\Hability\Tatuage', 'tatuageable');
    }
    
    /**
     * Projetos do Usuario - Refazer
     *
     * @param array $data
     * @return void
     */
    public function addProject($data)
    {
        // @todo Refazer
        return $this->infos()->create([
            'text' => implode(';', $data)
        ]);
    }
    /**
     * Accounts do Usuario - Refazer
     *
     * @param array $data
     * @return void
     */
    public function addAccount($data)
    {
        // @todo Refazer
        return $this->infos()->create([
            'text' => implode(';', $data)
        ]);
    }

    public function likes()
    {
        return $this->morphToMany('Siravel\Models\Identity\Person', 'personable');
    }

    /**
     * Events
     */
    protected static function bootAsHuman()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}

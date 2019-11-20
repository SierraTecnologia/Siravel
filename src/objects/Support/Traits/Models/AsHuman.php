<?php

namespace SiObjects\Support\Traits\Models;

use Illuminate\Support\Facades\Log;
// Podem Seguir
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanSubscribe;
use Overtrue\LaravelFollow\Traits\CanVote;
use Overtrue\LaravelFollow\Traits\CanBookmark;
// Podem Serem Seguidos
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

trait AsHuman
{
    use MakeEconomicActions, AsFofocavel;

    use CanFollow, CanLike, CanFavorite, CanSubscribe, CanVote, CanBookmark;
    use CanBeFollowed;

        
    /**
     * Get all of the owning personable models.
     */
    public function savePassword($password = '', $type = '')
    {
        // @todo Fazer
        return true;
    }


        
    // /**
    //  * Pega Relacao com as Proprias Pessoas
    //  * Get all of the owning personable models.
    //  */
    // public function personable()
    // {
    //     // @todo Verificar depois //return $this->morphTo(); //, 'personable_type', 'personable_code'
    // }


    /**
     * Aparece em videos
     */
    public function videos()
    {
        return $this->morphedByMany('Siravel\Models\Entytys\Digital\Midia\Video', 'personable');
    }

    /**
     * Aparece em fotos
     */
    public function images()
    {
        return $this->morphedByMany('Siravel\Models\Entytys\Digital\Midia\Image', 'personable');
    }

    /**
     * Get all of the post's accounts.
     */
    public function accounts()
    {
        return $this->morphToMany('Siravel\Models\Identity\Digital\Account', 'accountable');
    }

    /**
     * Worker e Tarefas
     */
    public function workers()
    {
        return $this->morphMany('Siravel\Models\Market\Actions\Worker', 'workerable');
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
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Skill', 'skillable');
    }
    public function itens()
    {
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Item', 'itemable');
    }
    public function productions()
    {
        return $this->morphToMany('Siravel\Models\Components\Productions\Production', 'productionable');
    }
    
    /**
     * One To Many (Polymorphic) - Feature FA
     *
     * @return void
     */
    public function pircings()
    {
        return $this->morphMany('Siravel\Models\Identity\Fisicos\Pircing', 'pircingable');
    }
    public function pintinhas()
    {
        return $this->morphMany('Siravel\Models\Identity\Fisicos\Pintinha', 'pintinhable');
    }
    public function tatuages()
    {
        return $this->morphMany('Siravel\Models\Identity\Fisicos\Tatuage', 'tatuageable');
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

    /**
     * Events
     */
    public static function bootAsHuman()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}

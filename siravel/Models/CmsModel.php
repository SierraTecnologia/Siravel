<?php

namespace Siravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Siravel\Models\Negocios\Link;
use Informate\Models\System\Archive;
use RicardoSierra\Translation\Models\Translation;


class CmsModel extends Model
{
    public function getBlocksAttribute($value)
    {
        $blocks = json_decode($value, true);

        if (is_null($blocks)) {
            $blocks = [];
        }

        return $blocks;
    }


    /**
     * Model contructuor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!empty(config('cms.db-prefix', ''))) {
            $this->table = config('cms.db-prefix', '').$this->table;
        }
    }

    /**
     * Get a model as a translatable object
     *
     * @return Object
     */
    public function asObject()
    {
        if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en')) {
            return $this->translationData(request('lang'));
        }

        return $this;
    }

    /**
     * After the item is saved to the database.
     *
     * @param object $payload
     */
    public function afterSaved($payload)
    {
        if (!request()->is('admin/revert/*') && !request()->is('admin/rollback/*/*')) {
            unset($payload->attributes['created_at']);
            unset($payload->attributes['updated_at']);
            unset($payload->original['created_at']);
            unset($payload->original['updated_at']);

            if ($payload->attributes != $payload->original) {
                Archive::create([
                    'token' => md5(time()),
                    'entity_id' => $payload->attributes['id'],
                    'entity_type' => get_class($payload),
                    'entity_data' => json_encode($payload->attributes),
                ]);
                Log::info(get_class($payload).' #'.$payload->attributes['id'].' was archived');
            }
        }
    }

    /**
     * When the item is being deleted.
     *
     * @param object $payload
     */
    public function beingDeleted($payload)
    {
        $type = get_class($payload);
        $id = $payload->id;

        Translation::where('entity_id', $id)->where('entity_type', $type)->delete();
        Archive::where('entity_id', $id)->where('entity_type', $type)->delete();

        Archive::where('entity_type', 'RicardoSierra\Translation\Models\Translation')
            ->where('entity_data', 'LIKE', '%"entity_id":'.$id.'%')
            ->where('entity_data', 'LIKE', '%"entity_type":"'.$type.'"%')
            ->delete();

        if ($type == 'Siravel\Models\Negocios\Page') {
            Link::where('page_id', $id)->delete();
        }
    }

    /**
     * A method for getting / setting blocks
     *
     * @param  string $slug
     * @return string
     */
    public function block($slug)
    {
        $block = $this->findABlock($slug);

        if (!$block) {
            $this->update([
                'blocks' => json_encode(array_merge($this->blocks, [ $slug => '' ]))
            ]);
        }

        return $block;
    }

    /**
     * Find a block based on slug
     *
     * @param  string $slug
     * @return string
     */
    public function findABlock($slug)
    {
        if (isset($this->blocks[$slug])) {
            return $this->blocks[$slug];
        }

        return false;
    }
}

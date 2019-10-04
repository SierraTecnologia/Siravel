<?php

namespace App\Http\Resources;

use App\Features\Photos\Entities\PostEntity;
use App\Features\Photos\Entities\TagEntity;
use function App\Util\to_object;

/**
 * Class PostResource.
 *
 * @package App\Http\Resources
 */
class PostResource extends PostPlainResource
{
    /**
     * @var PostEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'photo' => to_object($this->resource->getPhoto(), PhotoResource::class),
            'tags' => collect($this->resource->getTags())->map(function (TagEntity $tag) {
                return to_object($tag, TagPlainResource::class);
            }),
        ]);
    }
}

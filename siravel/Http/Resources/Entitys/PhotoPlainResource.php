<?php

namespace App\Http\Resources;

use App\Features\Photos\Entities\PhotoEntity;
use Illuminate\Http\Resources\Json\Resource;
use function App\Util\html_purify;
use function App\Util\to_int;
use function App\Util\to_string;

/**
 * Class PhotoPlainResource.
 *
 * @package App\Http\Resources
 */
class PhotoPlainResource extends Resource
{
    /**
     * @var PhotoEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id' => to_int(html_purify($this->resource->getId())),
            'created_by_user_id' => to_int(html_purify($this->resource->getCreatedByUserId())),
            'avg_color' => to_string(html_purify($this->resource->getAvgColor())),
            'created_at' => to_string(html_purify($this->resource->getCreatedAt()->toAtomString())),
        ];
    }
}

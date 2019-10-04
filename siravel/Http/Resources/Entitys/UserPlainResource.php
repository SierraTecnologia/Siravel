<?php

namespace SiObject\Http\Resources\Entitys;

use SiObjects\Manipule\Entities\UserEntity;
use Illuminate\Http\Resources\Json\Resource;
use function SiUtils\Helper\html_purify;
use function SiUtils\Helper\to_int;
use function SiUtils\Helper\to_string;

/**
 * Class UserPlainResource.
 *
 * @package SiObject\Http\Resources\Entitys
 */
class UserPlainResource extends Resource
{
    /**
     * @var UserEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        $visibleUserContacts = optional($request->user())->can('view-user-contacts', $this->resource);

        return [
            'id' => to_int(html_purify($this->resource->getId())),
            'name' => to_string(html_purify($this->resource->getName())),
            'email' => $this->when($visibleUserContacts, function () {
                return to_string(html_purify($this->resource->getEmail()));
            }),
            'role' => to_string(html_purify($this->resource->getRole())),
            'created_at' => to_string(html_purify($this->resource->getCreatedAt()->toAtomString())),
            'updated_at' => to_string(html_purify($this->resource->getUpdatedAt()->toAtomString())),
        ];
    }
}

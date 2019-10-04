<?php

namespace SiObjects\Manipule\Builders;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ThumbnailBuilder.
 *
 * @package App\Models\Builders
 */
class ThumbnailBuilder extends Builder
{
    /**
     * @return $this
     */
    public function whereHasNoPhotos()
    {
        return $this->doesntHave('photos');
    }
}

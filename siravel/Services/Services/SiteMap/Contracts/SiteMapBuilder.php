<?php

namespace App\Services\SiteMap\Contracts;

use SiObject\Mount\SiteMap\Contracts\Builder;

/**
 * Interface SiteMapBuilderService.
 *
 * @package App\Services\SiteMap\Contracts
 */
interface SiteMapBuilder
{
    /**
     * Build the sitemap.
     *
     * @return Builder
     */
    public function build(): Builder;
}

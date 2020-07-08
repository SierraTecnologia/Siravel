<?php

namespace Siravel\Services\SiteMap\Contracts;

use SiObjects\Mount\SiteMap\Contracts\Builder;

/**
 * Interface SiteMapBuilderService.
 *
 * @package Siravel\Services\SiteMap\Contracts
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

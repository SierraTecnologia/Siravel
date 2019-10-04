<?php

namespace Siravel\Services\Manifest\Contracts;

/**
 * Interface Manifest.
 *
 * @package Siravel\Services\SiteMap\Contracts
 */
interface Manifest
{
    /**
     * Get manifest content.
     *
     * @return array
     */
    public function get(): array;
}

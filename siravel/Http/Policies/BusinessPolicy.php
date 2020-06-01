<?php

namespace Siravel\Http\Policies;

use Siravel\Models\User;

/**
 * Class BusinessPolicy.
 *
 * @package Siravel\Http\Policies
 */
class BusinessPolicy
{

    public static function hasAccess($type, $target)
    {
        $policy = new self;

        if ($type=='feature') {
            return $policy->hasFeature($target);
        }

        if ($type=='widget') {
            return $policy->hasWidget($target);
        }

        if ($type=='plugin') {
            return $policy->hasPlugin($target);
        }

        return false;
    }

    /**
     * Create a resource.
     *
     * @param string $feature
     * @return bool
     */
    public function hasFeature(string $feature)
    {
        return \Siravel\Services\System\BusinessService::getSingleton()->hasFeature($feature);
    }

    /**
     * Create a resource.
     *
     * @param string $widget
     * @return bool
     */
    public function hasWidget(string $widget)
    {
        return \Siravel\Services\System\BusinessService::getSingleton()->hasWidget($widget);
    }

    /**
     * Create a resource.
     *
     * @param string $plugin
     * @return bool
     */
    public function hasPlugin(string $plugin)
    {
        return \Siravel\Services\System\BusinessService::getSingleton()->hasPlugin($plugin);
    }
}

<?php

namespace Siravel\Http;

use Facilitador\Http\MenuFilter as MenuFilterBase;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

// use Laratrust;

class MenuFilter extends MenuFilterBase
{
    public function transform($item)
    {
        // dd(app(\Siravel\Services\BusinessService::class));
        // if (!$this->verifyFeature($item)) {
        //     return false;
        // }
        return parent::transform($item); // $item; //
    }

    private function verifyFeature($item)
    {
        $feature = null;
        if (isset($item['feature'])) {
            $feature = $item['feature'];
        }

        if (empty($feature)) {
            return true;
        }

        return app(\Siravel\Services\BusinessService::class)->hasFeature($feature);
    }
}

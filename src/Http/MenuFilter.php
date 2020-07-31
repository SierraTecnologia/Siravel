<?php

namespace Siravel\Http;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

use Facilitador\Http\MenuFilter as MenuFilterBase;
// use Laratrust;

class MenuFilter extends MenuFilterBase
{
    public function transform($item, Builder $builder)
    {
        if (!$this->verifyFeature($item)) {
            return false;
        }
        return parent::transform($item, $builder);
    }

    private function verifyFeature($item)
    {
        $feature = null;
        if (isset($item['feature'])) {
            $feature = $item['feature'];
        }

        if (empty($feature)){
            return true;
        }

        return app(\Siravel\Services\System\BusinessService::class)->hasFeature($feature);
    }
}
<?php

namespace App\Http;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

// use Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        $user = Auth::user();

        if (!$this->verifyLevel($item, $user)) {
            return false;
        }

        if (!$this->verifyFeature($item, $user)) {
            return false;
        }

        // Translate
        $item["text"] = _t($item["text"]);

        return $item;
    }

    private function verifyFeature($item, $user)
    {
        $feature = null;
        if (isset($item['feature'])) {
            $feature = $item['feature'];
        }

        if (empty($feature)){
            return true;
        }

        return \Siravel\Services\System\BusinessService::getSingleton()->hasFeature($feature);
    }

    private function verifyLevel($item, $user)
    {
        $level = 0;
        if (isset($item['level'])) {
            $level = (int) $item['level'];
        }

        // Possui level inteiro e usuario nao logado
        if ($level>0 && !$user) {
            return false;
        }

        if ($level > $user->getLevelForAcessInBusiness()) {
            return false;
        }

        return true;
    }
}
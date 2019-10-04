<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller as BaseController;
use App\Article;
use App\ArticleCategory;
use App\Language;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class Controller extends BaseController {

    protected $menu = [];

    public function menuProduction()
    {
        $this->menu[0][Stage::$ESBOCO] = [
            'items',
            'scenes',
            'characters'
        ];

        $this->menu[0][Stage::$HISTORY] = [
            
        ];

        $this->menu[0][Stage::$ROTEIRO] = [
            
        ];

        $this->menu[0][Stage::$PRODUCTION] = [
            
        ];
    }
}

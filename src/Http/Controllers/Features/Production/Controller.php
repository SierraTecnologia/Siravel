<?php

namespace Siravel\Http\Controllers\Features\Production;

use Siravel\Http\Controllers\Features\Controller as BaseController;
use App\Models\Blog\Article;
use App\Models\Blog\Category;
use Translation\Models\Language;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;

class Controller extends BaseController
{

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

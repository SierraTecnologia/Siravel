<?php

namespace Siravel\Http\Controllers\Modules\Production;

use Siravel\Http\Controllers\Controller as BaseController;
use App\Article;
use App\ArticleCategory;
use Siravel\Models\System\Language;
use Illuminate\Support\Facades\Input;
use SiObject\Http\Requests\Admin\ArticleRequest;
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

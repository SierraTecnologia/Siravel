<?php

namespace Siravel\Providers;

use Siravel\Services\System\BusinessService;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class BusinessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Carrega o Negócio caso não tenha carregado antes
        BusinessService::getSingleton();

        $theme = Config::get('cms.frontend-theme');
        
        View::addLocation(base_path('resources/themes/'.$theme));
        View::addNamespace('cms-frontend', base_path('resources/themes/'.$theme));

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $view = '"cms-frontend::'.str_replace('"', '', str_replace("'", '', $expression)).'"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('themejs', function ($expression) use ($theme) {
            return "<?php echo Minify::javascript('/../resources/themes/$theme/assets/js/'.$expression); ?>";
        });

        Blade::directive('themecss', function ($expression) use ($theme) {
            return "<?php echo Minify::stylesheet('/../resources/themes/$theme/assets/css/'.$expression); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // $this->commands([
        //     ThemeGenerate::class,
        //     ThemePublish::class,
        //     ModulePublish::class,
        //     ModuleMake::class,
        //     ModuleComposer::class,
        //     ModuleCrud::class,
        //     Setup::class,
        //     LangTranslate::class,
        //     Keys::class,
        //     DeleteExpiredActivations::class,
        // ]);
    }
}

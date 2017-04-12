<?php

namespace App\Providers;

use App\Services\Routing\Binder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Contracts\Routing\BindingRegistrar;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Binder::class, function (Container $app) {
            return new Binder();
        });

        $this->app->resolving(BindingRegistrar::class, function (BindingRegistrar $registrar, Container $app) {
            $binder = $app->make(Binder::class);

            $registrar->apply($binder);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $router = Route::middleware('web')
            ->namespace($this->namespace);

        $router->group(base_path('routes/web.php'));

        $router->get('/{template}', [
            'as' => 'get::template',
            'uses' => 'TemplateController@show',
        ]);
    }
}

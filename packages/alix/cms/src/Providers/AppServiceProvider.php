<?php

namespace Alix\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use Alix\Cms\Http\Middleware\Authenticate;
use Alix\Cms\Console\CreateAdminCommand;
use Alix\Cms\View\Components\Sidebar;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');
        // $this->publishes([
        //     __DIR__ . '/../resources/views' => resource_path('views/vendor/alix-cms'),
        // ]);
        $this->loadViewComponentsAs('cms', [
            Sidebar::class,
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->addMiddlewareAlias('cms_auth', Authenticate::class);
        // $this->publishes([
        //     __DIR__ . '/../database/migrations/' => database_path('migrations')
        // ], 'migrations');
        // $this->publishes([__DIR__.'/config' => config_path()], 'alix-cms-config');
        // $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'alix-cms-lang');
        $this->publishes([__DIR__ . '/../resources/assets' => public_path('vendor/cms')], 'public');
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateAdminCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cms', function () {
            return new Cms;
        });
    }
    protected function addMiddlewareAlias($name, $class)
    {
        $router = $this->app['router'];

        if (method_exists($router, 'aliasMiddleware')) {
            return $router->aliasMiddleware($name, $class);
        }
        return $router->middleware($name, $class);
    }
}

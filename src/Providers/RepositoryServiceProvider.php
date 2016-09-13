<?php

namespace Samcrosoft\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 * @package Samcrosoft\LaravelModules\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $driver = ucfirst(config('modules.driver'));

        if ($driver == 'Custom') {
            $namespace = config('modules.custom_driver');
        } else {
            $namespace = 'Samcrosoft\LaravelModules\Repositories\\'.$driver.'Repository';
        }

        $this->app->bind('Samcrosoft\LaravelModules\Contracts\Repository', $namespace);
    }
}

<?php

namespace Samcrosoft\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;
use Samcrosoft\LaravelModules\Console\Destroyers\ModuleDestroyCommand;

/**
 * Class GeneratorServiceProvider
 *
 * @package Samcrosoft\LaravelModules\Providers
 */
class DestroyerServiceProvider extends ServiceProvider
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
        $this->registerDestroyModuleCommand();
    }


    /**
     * Register the command.destroy.module command
     */
    private function registerDestroyModuleCommand()
    {
        $this->app->singleton('command.destroy.module', function ($app) {
            return $app[ModuleDestroyCommand::class];
        });

        $this->commands('command.destroy.module');
    }
}

<?php

namespace Samcrosoft\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;
use Samcrosoft\LaravelModules\Console\Generators\MakeConsoleCommand;
use Samcrosoft\LaravelModules\Console\Generators\MakeMiddlewareCommand;
use Samcrosoft\LaravelModules\Console\Generators\MakeMigrationCommand;
use Samcrosoft\LaravelModules\Console\Generators\MakeModelCommand;
use Samcrosoft\LaravelModules\Console\Generators\MakeModuleCommand;
use Samcrosoft\LaravelModules\Console\Generators\MakeRequestCommand;
use Samcrosoft\LaravelModules\Console\Generators\MakeSeederCommand;

/**
 * Class GeneratorServiceProvider
 *
 * @package Samcrosoft\LaravelModules\Providers
 */
class GeneratorServiceProvider extends ServiceProvider
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
        $this->registerMakeControllerCommand();
        $this->registerMakeMiddlewareCommand();
        $this->registerMakeMigrationCommand();
        $this->registerMakeModelCommand();
        $this->registerMakeModuleCommand();
        $this->registerMakeRequestCommand();
        $this->registerMakeSeederCommand();

        /*
         * Console command
         */
        $this->registerMakeConsoleCommand();
    }

    /**
     * Register the make:module:controller command.
     */
    private function registerMakeControllerCommand()
    {
        $this->app->singleton('command.make.module.controller', function ($app) {
            return $app[MakeMigrationCommand::class];
        });

        $this->commands('command.make.module.controller');
    }

    /**
     * Register the make:module:middleware command.
     */
    private function registerMakeMiddlewareCommand()
    {
        $this->app->singleton('command.make.module.middleware', function ($app) {
            return $app[MakeMiddlewareCommand::class];
        });

        $this->commands('command.make.module.middleware');
    }

    /**
     * Register the make:module:migration command.
     */
    private function registerMakeMigrationCommand()
    {
        $this->app->singleton('command.make.module.migration', function ($app) {
            return $app[MakeMigrationCommand::class];
        });

        $this->commands('command.make.module.migration');
    }

    /**
     * Register the make:module:model command.
     */
    private function registerMakeModelCommand()
    {
        $this->app->singleton('command.make.module.model', function ($app) {
            return $app[MakeModelCommand::class];
        });

        $this->commands('command.make.module.model');
    }

    /**
     * Register the make:module command.
     */
    private function registerMakeModuleCommand()
    {
        $this->app->singleton('command.make.module', function ($app) {
            return $app[MakeModuleCommand::class];
        });

        $this->commands('command.make.module');
    }

    /**
     * Register the make:module:request command.
     */
    private function registerMakeRequestCommand()
    {
        $this->app->singleton('command.make.module.request', function ($app) {
            return $app[MakeRequestCommand::class];
        });

        $this->commands('command.make.module.request');
    }

    /**
     * Register the make:module:seeder command.
     */
    private function registerMakeSeederCommand()
    {
        $this->app->singleton('command.make.module.seeder', function ($app) {
            return $app[MakeSeederCommand::class];
        });

        $this->commands('command.make.module.seeder');
    }

    /**
     * Register the make:module:command command.
     */
    private function registerMakeConsoleCommand()
    {
        $this->app->singleton('command.make.module.command', function ($app) {
            return $app[MakeConsoleCommand::class];
        });

        $this->commands('command.make.module.command');
    }
}

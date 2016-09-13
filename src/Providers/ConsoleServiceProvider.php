<?php

namespace Samcrosoft\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;
use Samcrosoft\LaravelModules\Console\Commands\ModuleDisableCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleEnableCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleListCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleMigrateCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleMigrateRefreshCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleMigrateResetCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleMigrateRollbackCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleOptimizeCommand;
use Samcrosoft\LaravelModules\Console\Commands\ModuleSeedCommand;

/**
 * Class ConsoleServiceProvider
 *
 * @package Samcrosoft\LarvelModules\Providers
 */
class ConsoleServiceProvider extends ServiceProvider
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
        $this->registerDisableCommand();
        $this->registerEnableCommand();
        $this->registerListCommand();
        $this->registerMigrateCommand();
        $this->registerMigrateRefreshCommand();
        $this->registerMigrateResetCommand();
        $this->registerMigrateRollbackCommand();
        $this->registerOptimizeCommand();
        $this->registerSeedCommand();
    }

    /**
     * Register the module:disable command.
     */
    protected function registerDisableCommand()
    {
        $this->app->singleton('command.module.disable', function () {
            return new ModuleDisableCommand();
        });

        $this->commands('command.module.disable');
    }

    /**
     * Register the module:enable command.
     */
    protected function registerEnableCommand()
    {
        $this->app->singleton('command.module.enable', function () {
            return new ModuleEnableCommand();
        });

        $this->commands('command.module.enable');
    }

    /**
     * Register the module:list command.
     */
    protected function registerListCommand()
    {
        $this->app->singleton('command.module.list', function ($app) {
            return new ModuleListCommand($app['modules']);
        });

        $this->commands('command.module.list');
    }

    /**
     * Register the module:migrate command.
     */
    protected function registerMigrateCommand()
    {
        $this->app->singleton('command.module.migrate', function ($app) {
            return new ModuleMigrateCommand($app['migrator'], $app['modules']);
        });

        $this->commands('command.module.migrate');
    }

    /**
     * Register the module:migrate:refresh command.
     */
    protected function registerMigrateRefreshCommand()
    {
        $this->app->singleton('command.module.migrate.refresh', function () {
            return new ModuleMigrateRefreshCommand();
        });

        $this->commands('command.module.migrate.refresh');
    }

    /**
     * Register the module:migrate:reset command.
     */
    protected function registerMigrateResetCommand()
    {
        $this->app->singleton('command.module.migrate.reset', function ($app) {
            return new ModuleMigrateResetCommand($app['modules'], $app['files'], $app['migrator']);
        });

        $this->commands('command.module.migrate.reset');
    }

    /**
     * Register the module:migrate:rollback command.
     */
    protected function registerMigrateRollbackCommand()
    {
        $this->app->singleton('command.module.migrate.rollback', function ($app) {
            return new ModuleMigrateRollbackCommand($app['modules']);
        });

        $this->commands('command.module.migrate.rollback');
    }

    /**
     * Register the module:optimize command.
     */
    protected function registerOptimizeCommand()
    {
        $this->app->singleton('command.module.optimize', function () {
            return new ModuleOptimizeCommand();
        });

        $this->commands('command.module.optimize');
    }

    /**
     * Register the module:seed command.
     */
    protected function registerSeedCommand()
    {
        $this->app->singleton('command.module.seed', function ($app) {
            return new ModuleSeedCommand($app['modules']);
        });

        $this->commands('command.module.seed');
    }
}

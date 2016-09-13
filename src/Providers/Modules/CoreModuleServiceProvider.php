<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 11/09/2016
 * Time: 21:24
 */

namespace Samcrosoft\LaravelModules\Providers\Modules;


use Illuminate\Support\ServiceProvider;

/**
 * Class CoreModuleServiceProvider
 *
 * @package Samcrosoft\LaravelModules\Providers\Modules
 */
class CoreModuleServiceProvider extends ServiceProvider
{

    public function register()
    {
        /*
         * Register all the core module service providers
         */
        $this->app->register(ModuleConfigServiceProvider::class);
        $this->app->register(ModuleKernelHandlerServiceProvider::class);
        //$this->app->register(ModuleLanguageServiceProvider::class);
        $this->app->register(ModuleViewServiceProvider::class);
    }

}
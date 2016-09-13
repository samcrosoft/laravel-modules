<?php
/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 17/08/2016
 * Time: 15:54
 */

namespace Samcrosoft\LaravelModules\Providers\Modules;


use Illuminate\Support\ServiceProvider;
use Samcrosoft\LaravelModules\Modules;

/**
 * Class ModuleViewServiceProvider
 * @package Shiloh\Custom\Packages\Modules\Providers
 */
class ModuleViewServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        /** @var Modules $repository */
        $repository = $this->getModuleRepository();

        $oEnabledModules = $repository->allEnabled();

        $oEnabledModules->each(function ($aModuleProperties) {
            $this->registerViewLocations($aModuleProperties);
        });
    }


    /**
     * This will return the module repository
     * @return Modules
     */
    private function getModuleRepository()
    {
        $repository = $this->app->make("modules");
        return $repository;
    }

    /**
     * This will register the modules for the current o
     * @param array $aModuleProperties
     */
    protected function registerViewLocations($aModuleProperties)
    {
        /*
         * Add routes, if available
         */
        $oRepository = $this->getModuleRepository();
        $sModuleSlug = $oRepository->resolveSlug($aModuleProperties);
        $sModuleViewPath = $oRepository->getModuleFolderPath($sModuleSlug, "resources/views");
        $sAppVendorViewPath = base_path("resources/views/vendor/{$sModuleSlug}");


        if (is_dir($appPath = $sAppVendorViewPath)) {
            $this->app['view']->addNamespace($sModuleSlug, $appPath);
        }

        $this->app['view']->addNamespace($sModuleSlug, $sModuleViewPath);

    }

}
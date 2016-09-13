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
 * Class ModuleLanguageServiceProvider
 * @package Shiloh\Custom\Packages\Modules\Providers
 */
class ModuleLanguageServiceProvider extends ServiceProvider
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
            $this->registerLangLocations($aModuleProperties);
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
    protected function registerLangLocations($aModuleProperties)
    {
        /*
         * Add languages, if available
         */
        $oRepository = $this->getModuleRepository();
        $sModuleSlug = $oRepository->resolveSlug($aModuleProperties);
        $sModuleLangPath = $oRepository->getModuleFolderPath($sModuleSlug, "resources/lang");
        $this->app['translator']->addNamespace($sModuleSlug, $sModuleLangPath);

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 02/09/2016
 * Time: 10:57
 */

namespace Samcrosoft\LaravelModules\Providers\Modules;


use Illuminate\Support\ServiceProvider;
use Samcrosoft\LaravelModules\Modules;

/**
 * Class ModuleConfigServiceProvider
 * @package Shiloh\Custom\Packages\Modules\Providers
 */
class ModuleConfigServiceProvider extends ServiceProvider
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
            $this->registerConfigLocations($aModuleProperties);
            $this->registerAutoLoadProviders($aModuleProperties);
        });
    }



    /**
     * This will register the config namespace for the modules
     * @param array $aModuleProperties
     */
    protected function registerConfigLocations($aModuleProperties)
    {
        /*
         * Add config, if available
         */
        $oRepository = $this->getModuleRepository();
        $sModuleSlug = $oRepository->resolveSlug($aModuleProperties);
        $sModuleLangPath = $oRepository->getModuleFolderPath($sModuleSlug, "config");

        // load the config into the namespace
        $this->loadConfigFromDirectory($sModuleLangPath, $sModuleSlug);

    }

    /**
     * Register a config file namespace.
     *
     * @param  string $path
     * @param  string $namespace
     *
     * @return void
     */
    protected function loadConfigFromDirectory($path, $namespace)
    {
        $path = realpath($path);
        if ($path && \File::isDirectory($path)) {

            foreach (\File::files($path) as $sFile) {
                $sBaseName = basename($sFile, ".php");
                $sNamespace = $namespace . "::{$sBaseName}";
                parent::mergeConfigFrom($sFile, $sNamespace);
            }
        }
    }

    /**
     * This will map all the providers
     *
     * @param array $aModuleProperties
     */
    public function registerAutoLoadProviders($aModuleProperties)
    {
        $oRepository = $this->getModuleRepository();
        $sModuleSlug = $oRepository->resolveSlug($aModuleProperties);
        $sConfigPath = "$sModuleSlug::autoload.providers";
        $aAutoLoadProviders = config($sConfigPath);

        
        if (!empty($aAutoLoadProviders) && is_array($aAutoLoadProviders)) {
            foreach ($aAutoLoadProviders as $sAutoLoadProvider) {
                #dd($sConfigPath, $sAutoLoadProvider);
                if (class_exists($sAutoLoadProvider))
                    {
                        #dd("getting in here");
                        $this->app->register($sAutoLoadProvider);
                    }
            }
        }
    }

    /**
     * This will map all the aliases
     *
     * @param string $sModuleName
     */
    public function registerAutoLoadAliasesClasses($sModuleName)
    {
        $aAutoLoadClasses = config("$sModuleName::autoload.aliases");

        if (!empty($aAutoLoadClasses)) {
            foreach ($aAutoLoadClasses as $sKey => $sAutoLoadClass) {
                if (class_exists($sAutoLoadClass))
                    $this->app->alias($sKey, $sAutoLoadClass);
            }
        }
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

}
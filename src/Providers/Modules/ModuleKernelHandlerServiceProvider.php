<?php
/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 02/09/2016
 * Time: 11:34
 */

namespace Samcrosoft\LaravelModules\Providers\Modules;


use Illuminate\Support\ServiceProvider;
use Samcrosoft\LaravelModules\Support\ModuleKernel;
use Samcrosoft\LaravelModules\Modules;

/**
 * Class ModuleKernelHandlerServiceProvider
 *
 * @package Shiloh\Custom\Packages\Modules\Providers
 */
class ModuleKernelHandlerServiceProvider extends ServiceProvider
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
            $this->registerModuleKernel($aModuleProperties);
        });
    }

    /**
     * @param array $aModuleProperties
     */
    protected function registerModuleKernel($aModuleProperties)
    {
        /*
         * Add config, if available
         */
        $oRepository = $this->getModuleRepository();
        $sKernelNamespace = $oRepository->resolveAbsoluteKernelNamespace($aModuleProperties);
        if (class_exists($sKernelNamespace)) {
            $this->loadKernelMiddleware($sKernelNamespace);
        }

    }

    /**
     * This will load the middleware in the module
     *
     * @param string $sModuleNamespace
     */
    protected function loadKernelMiddleware($sModuleNamespace)
    {

        /**
         * @var ModuleKernel $oModuleKernel
         */
        $oModuleKernel = app($sModuleNamespace);

        if (is_object($oModuleKernel) && $oModuleKernel instanceof ModuleKernel) {
            $oRouter = $this->getRouter();
            foreach ($oModuleKernel->getMiddlewareGroups() as $key => $middleware) {
                $oRouter->middlewareGroup($key, $middleware);
            }

            foreach ($oModuleKernel->getRouteMiddleware() as $key => $middleware) {
                $oRouter->middleware($key, $middleware);
            }
        }
    }


    /**
     * @return \Route
     */
    private function getRouter()
    {
        /** @var \Route $oRouter */
        $oRouter = $this->app['router'];
        return $oRouter;
    }


    /**
     * This will return the module repository
     *
     * @return Modules
     */
    private function getModuleRepository()
    {
        $repository = $this->app->make("modules");
        return $repository;
    }
}
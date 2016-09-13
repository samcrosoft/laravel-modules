<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 11/09/2016
 * Time: 21:21
 */

namespace Samcrosoft\LaravelModules\Support;


abstract class ModuleKernel
{
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [];


    /**
     * @return array
     */
    public function getMiddlewareGroups()
    {
        return $this->middlewareGroups;
    }


    /**
     * @return array
     */
    public function getRouteMiddleware()
    {
        return $this->routeMiddleware;
    }

}
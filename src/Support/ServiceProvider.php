<?php

namespace Samcrosoft\LaravelModules\Support;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package Samcrosoft\LarvelModules\Support
 */
class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * This is the slug for the module
     *
     * @var null|string
     */
    var $slug = null;


    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Intentionally left blank.
    }

    /**
     * @return null|string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}

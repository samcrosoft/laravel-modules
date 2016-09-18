<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 17/09/2016
 * Time: 20:54
 */

namespace Samcrosoft\LaravelModules\Support;


/**
 * Class ConsoleKernel
 *
 * @package Samcrosoft\LaravelModules\Support
 */
abstract class ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];


    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }


}
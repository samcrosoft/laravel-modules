<?php

namespace Samcrosoft\LaravelModules\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class ModuleOptimizeCommand
 *
 * @package Samcrosoft\LarvelModules\Console\Commands
 */
class ModuleOptimizeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize the module cache for better performance';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->info('Generating optimized module cache');

        $this->laravel['modules']->optimize();

        event('modules.optimized');
    }
}

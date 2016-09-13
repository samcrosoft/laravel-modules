<?php

namespace Samcrosoft\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Samcrosoft\LaravelModules\Modules;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ModuleDisableCommand
 *
 * @package Samcrosoft\LarvelModules\Console\Commands
 */
class ModuleDisableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable a module';

    /**
     * Execute the console command.
     *
     */
    public function fire()
    {
        $slug = $this->argument('slug');

        /** @var Modules $oModule */
        $oModule = $this->laravel['modules'];
        if ($oModule->isEnabled($slug)) {
            $oModule->disable($slug);

            $module = $oModule->where('slug', $slug);

            event($slug.'.module.disabled', [$module, null]);

            $this->info('Module was disabled successfully.');
        } else {
            $this->comment('Module is already disabled.');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['slug', InputArgument::REQUIRED, 'Module slug.'],
        ];
    }
}

<?php

namespace Samcrosoft\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Samcrosoft\LaravelModules\Modules;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ModuleEnableCommand
 *
 * @package Samcrosoft\LarvelModules\Console\Commands
 */
class ModuleEnableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable a module';

    /**
     * Execute the console command.
     *
     */
    public function fire()
    {
        $slug = $this->argument('slug');

        /** @var Modules $oModule */
        $oModule = $this->laravel['modules'];
        if ($oModule->isDisabled($slug)) {
            $oModule->enable($slug);

            $module = $oModule->where('slug', $slug);

            event($slug . '.module.enabled', [$module, null]);

            $this->info('Module was enabled successfully.');
        } else {
            $this->comment('Module is already enabled.');
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

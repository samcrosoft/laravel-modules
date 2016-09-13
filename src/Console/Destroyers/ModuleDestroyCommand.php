<?php
/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 13/09/2016
 * Time: 16:10
 */

namespace Samcrosoft\LaravelModules\Console\Destroyers;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Samcrosoft\LaravelModules\Modules;

/**
 * Class ModuleDestroyCommand
 * @package Samcrosoft\LaravelModules\Console\Destroyers
 */
class ModuleDestroyCommand extends Command
{

    /**
     * The modules instance.
     *
     * @var Modules
     */
    protected $module;

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destroy:module
        {slug : The slug of the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy a new Samcrosoft module, No Undo - Use carefully!';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @param Modules $module
     */
    public function __construct(Filesystem $files, Modules $module)
    {
        parent::__construct();

        $this->files = $files;
        $this->module = $module;
    }

    public function fire()
    {
        $slug = $this->argument('slug');

        if (!$this->files->isDirectory($this->module->getPath())) {
            $this->warn("You do not have any module installed!");
        } else {
            if ($this->confirm('Do you wish to continue?')) {
                $this->comment('Thanks! That\'s all we need.');
                $this->line('-----------------------------');
                $this->comment('Now relax while your module is trashed for you.');

                $this->trashModule($slug);
            } else {
                $this->info("Goodbye!");
            }
        }
    }

    /**
     * @param $slug
     * @param bool $outcome
     */
    public function informAboutOutcome($slug, $outcome = true)
    {
        if ($outcome === true) {
            $this->info("Module - {$slug} -  Trashed Successfully");
        } else {
            $this->error("Module - {$slug} - Not Trashed Successfully");
        }
    }

    /**
     * This method will trash the module
     * @param $slug
     */
    private function trashModule($slug)
    {
        $module_path = $this->module->getModulePath($slug);
        if ($this->files->isDirectory($module_path)) {
            try {
                $status = $this->files->deleteDirectory($module_path);
                $this->informAboutOutcome($slug, $status);
            } catch (\Exception $e) {
                $this->informAboutOutcome($slug, false);
            }
        }


        /*
         * optimize the modules
         */
        $this->optimizeModules();
    }

    /**
     * Reset module cache of enabled and disabled modules.
     */
    protected function optimizeModules()
    {
        return $this->callSilent('module:optimize');
    }

}
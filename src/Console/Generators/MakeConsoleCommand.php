<?php
/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 17/09/2016
 * Time: 16:39
 */

namespace Samcrosoft\LaravelModules\Console\Generators;
use Illuminate\Support\Str;

/**
 * Class MakeConsoleCommand
 *
 * @package Samcrosoft\LaravelModules\Console\Generators
 */
class MakeConsoleCommand extends MakeCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:command
    	{slug : The slug of the module}
    	{name : The name of the command}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module console command';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Command';

    /**
     * Module folders to be created.
     *
     * @var array
     */
    protected $listFolders = [
        'app/Console/Commands/',
    ];

    /**
     * Module files to be created.
     *
     * @var array
     */
    protected $listFiles = [
        '{{filename}}.php',
    ];

    /**
     * Module signature option.
     *
     * @var array
     */
    protected $signOption = [];

    /**
     * Module stubs used to populate defined files.
     *
     * @var array
     */
    protected $listStubs = [
        'default' => [
            'console.stub',
        ]
    ];

    /**
     * Resolve Container after getting file path.
     *
     * @param string $filePath
     *
     * @return array|void
     */
    protected function resolveByPath($filePath)
    {
        $this->container['filename']  = $this->makeFileName($filePath);
        $this->container['namespace'] = $this->getNamespace($filePath);
        $this->container['path']      = $this->module->getNamespace();
        $this->container['slug']      = Str::slug($this->argument('slug'));
        $this->container['name']      = Str::camel($this->container['slug']);
        $this->container['classname'] = basename($filePath);

        return;
    }

    /**
     * Replace placeholder text with correct values.
     *
     * @param $content
     * @return string
     */
    protected function formatContent($content)
    {
        return str_replace(
            [
                '{{filename}}',
                '{{path}}',
                '{{name}}',
                '{{namespace}}',
                '{{classname}}',
            ],
            [
                $this->container['filename'],
                $this->container['path'],
                $this->container['name'],
                $this->container['namespace'],
                $this->container['classname'],
            ],
            $content
        );
    }
}

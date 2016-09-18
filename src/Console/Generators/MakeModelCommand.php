<?php

namespace Samcrosoft\LaravelModules\Console\Generators;

/**
 * Class MakeModelCommand
 *
 * @package Samcrosoft\LaravelModules\Console\Generators
 */
class MakeModelCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:model
    	{slug : The slug of the module.}
    	{name : The name of the model class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module model class';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Module folders to be created.
     *
     * @var array
     */
    protected $listFolders = [
        'app/Models/',
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
     * Module stubs used to populate defined files.
     *
     * @var array
     */
    protected $listStubs = [
        'default' => [
            'model.stub',
        ],
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
        $this->container['path']      = $this->getBaseNamespace();
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
                '{{namespace}}',
                '{{classname}}',
            ],
            [
                $this->container['filename'],
                $this->container['path'],
                $this->container['namespace'],
                $this->container['classname'],
            ],
            $content
        );
    }
}

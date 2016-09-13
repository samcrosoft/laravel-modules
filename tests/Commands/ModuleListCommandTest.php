<?php
namespace Tests\Commands;
use Artisan;
use Mockery as m;
use Samcrosoft\LaravelModules\Console\Commands\ModuleListCommand;
use Samcrosoft\LaravelModules\ModulesServiceProvider;
use Tests\BaseTestCase;

/**
 * Class ModuleListCommandTest
 */
class ModuleListCommandTest extends BaseTestCase
{

    public function getPackageProviders($app)
    {
        return [
            ModulesServiceProvider::class
        ];
    }

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testModulesList()
    {
        $this->artisan("module:list");
        $output = Artisan::output();
        $this->assertStringStartsWith(ModuleListCommand::EMPTY_MESSAGE, $output);
    }

}

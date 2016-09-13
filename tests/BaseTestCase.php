<?php
namespace Tests;

/**
 * Class BaseTestCase
 */
abstract class BaseTestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';
}

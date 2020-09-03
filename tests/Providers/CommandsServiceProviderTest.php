<?php namespace TobyYan\LogViewer\Tests\Providers;

use TobyYan\LogViewer\Providers\CommandsServiceProvider;
use TobyYan\LogViewer\Tests\TestCase;

/**
 * Class     CommandsServiceProviderTest
 *
 * @package  TobyYan\LogViewer\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class CommandsServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var CommandsServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(CommandsServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \TobyYan\Support\ServiceProvider::class,
            CommandsServiceProvider::class
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            \TobyYan\LogViewer\Commands\PublishCommand::class,
            \TobyYan\LogViewer\Commands\StatsCommand::class,
            \TobyYan\LogViewer\Commands\CheckCommand::class,
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}

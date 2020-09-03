<?php namespace TobyYan\LogViewer\Tests\Utilities;

use TobyYan\LogViewer\Tests\TestCase;
use TobyYan\LogViewer\Utilities\LogChecker;

/**
 * Class     LogCheckerTest
 *
 * @package  TobyYan\LogViewer\Tests\Utilities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogCheckerTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var LogChecker */
    private $checker;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->checker = $this->app->make(\TobyYan\LogViewer\Contracts\Utilities\LogChecker::class);
    }

    public function tearDown()
    {
        unset($this->checker);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(LogChecker::class, $this->checker);
    }

    /** @test */
    public function it_must_fails()
    {
        $this->assertFalse($this->checker->passes());
        $this->assertTrue($this->checker->fails());
    }

    /** @test */
    public function it_can_get_messages()
    {
        $messages = $this->checker->messages();

        $this->assertArrayHasKey('handler', $messages);
        $this->assertArrayHasKey('files', $messages);
        $this->assertEmpty($messages['handler']);
        $this->assertCount(3, $messages['files']);
        $this->assertArrayHasKey('laravel.log', $messages['files']);
    }

    /** @test */
    public function it_can_get_requirements()
    {
        $requirements = $this->checker->requirements();

        $this->assertArrayHasKey('status', $requirements);
        $this->assertEquals($requirements['status'], 'success');
        $this->assertArrayHasKey('header', $requirements);
        $this->assertEquals($requirements['header'], 'Application requirements fulfilled.');
    }

    /** @test */
    public function it_must_fail_the_requirements_on_handler()
    {
        config()->set('app.log', 'single');

        $requirements = $this->checker->requirements();

        $this->assertArrayHasKey('status', $requirements);
        $this->assertEquals($requirements['status'], 'failed');
        $this->assertArrayHasKey('header', $requirements);
        $this->assertEquals($requirements['header'], 'Application requirements failed.');
    }
}

<?php namespace TobyYan\LogViewer\Tests\Commands;

use TobyYan\LogViewer\Tests\TestCase;

/**
 * Class     CheckCommandTest
 *
 * @package  TobyYan\LogViewer\Tests\Commands
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class CheckCommandTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_check()
    {
        $code = $this->artisan('log-viewer:check');

        $this->assertEquals(0, $code);
    }
}

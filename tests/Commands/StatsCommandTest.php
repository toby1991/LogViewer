<?php namespace TobyYan\LogViewer\Tests\Commands;

use TobyYan\LogViewer\Tests\TestCase;

/**
 * Class     StatsCommandTest
 *
 * @package  TobyYan\LogViewer\Tests\Commands
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class StatsCommandTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_display_stats()
    {
        $code = $this->artisan('log-viewer:stats');

        $this->assertEquals(0, $code);
    }
}

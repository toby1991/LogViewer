<?php namespace TobyYan\LogViewer\Tests\Utilities;

use TobyYan\LogViewer\Tests\TestCase;
use TobyYan\LogViewer\Utilities\LogMenu;

/**
 * Class     LogMenuTest
 *
 * @package  TobyYan\LogViewer\Tests\Utilities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogMenuTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var LogMenu */
    private $menu;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->menu = $this->app->make(\TobyYan\LogViewer\Contracts\Utilities\LogMenu::class);
    }

    public function tearDown()
    {
        unset($this->menu);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(LogMenu::class, $this->menu);
    }

    /** @test */
    public function it_can_make_menu_with_helper()
    {
        $log = $this->getLog('2015-01-01');

        $expected = [
            'all'       => [
                'name'  => 'All',
                'count' => 8,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/all',
                'icon'  => '<i class="fa fa-fw fa-list"></i>',
            ],
            'emergency' => [
                'name'  => 'Emergency',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/emergency',
                'icon'  => '<i class="fa fa-fw fa-bug"></i>',
            ],
            'alert'     => [
                'name'  => 'Alert',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/alert',
                'icon'  => '<i class="fa fa-fw fa-bullhorn"></i>',
            ],
            'critical'  => [
                'name'  => 'Critical',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/critical',
                'icon'  => '<i class="fa fa-fw fa-heartbeat"></i>',
            ],
            'error'     => [
                'name'  => 'Error',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/error',
                'icon'  => '<i class="fa fa-fw fa-times-circle"></i>',
            ],
            'warning'   => [
                'name'  => 'Warning',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/warning',
                'icon'  => '<i class="fa fa-fw fa-exclamation-triangle"></i>',
            ],
            'notice'    => [
                'name'  => 'Notice',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/notice',
                'icon'  => '<i class="fa fa-fw fa-exclamation-circle"></i>',
            ],
            'info'      => [
                'name'  => 'Info',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/info',
                'icon'  => '<i class="fa fa-fw fa-info-circle"></i>',
            ],
            'debug'     => [
                'name' => 'Debug',
                'count' => 1,
                'url'   => 'http://localhost/log-viewer/logs/2015-01-01/debug',
                'icon'  => '<i class="fa fa-fw fa-life-ring"></i>',
            ],
        ];

        $this->assertSame($expected, $menu = log_menu()->make($log));
    }
}

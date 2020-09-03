<?php namespace TobyYan\LogViewer\Tests\Utilities;

use TobyYan\LogViewer\Tests\TestCase;
use TobyYan\LogViewer\Utilities\Factory;

/**
 * Class     FactoryTest
 *
 * @package  TobyYan\LogViewer\Tests\Utilities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FactoryTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Factory */
    private $logFactory;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->logFactory = $this->app->make(\TobyYan\LogViewer\Contracts\Utilities\Factory::class);
    }

    public function tearDown()
    {
        unset($this->logFactory);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Factory::class, $this->logFactory);
    }

    /** @test */
    public function it_can_get_filesystem_object()
    {
        $expectations = [
            \TobyYan\LogViewer\Contracts\Utilities\Filesystem::class,
            \TobyYan\LogViewer\Utilities\Filesystem::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->logFactory->getFilesystem());
        }
    }

    /** @test */
    public function it_can_get_levels_object()
    {
        $expectations = [
            \TobyYan\LogViewer\Contracts\Utilities\LogLevels::class,
            \TobyYan\LogViewer\Utilities\LogLevels::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->logFactory->getLevels());
        }
    }

    /** @test */
    public function it_can_get_log_entries()
    {
        $date       = '2015-01-01';
        $logEntries = $this->logFactory->entries($date);

        foreach ($logEntries as $logEntry) {
            $this->assertLogEntry($date, $logEntry);
        }
    }

    /** @test */
    public function it_can_get_dates()
    {
        $dates = $this->logFactory->dates();

        $this->assertCount(2, $dates);
        $this->assertDates($dates);
    }

    /** @test */
    public function it_can_get_all_logs()
    {
        $logs = $this->logFactory->all();

        $this->assertInstanceOf(\TobyYan\LogViewer\Entities\LogCollection::class, $logs);
        $this->assertCount(2, $logs);
    }

    /** @test */
    public function it_can_paginate_all_logs()
    {
        $logs = $this->logFactory->paginate();

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $logs);
        $this->assertEquals(30, $logs->perPage());
        $this->assertEquals(2,  $logs->total());
        $this->assertEquals(1,  $logs->lastPage());
        $this->assertEquals(1,  $logs->currentPage());
    }

    /** @test */
    public function it_can_get_count()
    {
        $this->assertEquals(2, $this->logFactory->count());
    }

    /** @test */
    public function it_can_can_set_custom_path()
    {
        $this->logFactory->setPath(storage_path('custom-path-logs'));

        $this->assertEquals(1, $this->logFactory->count());

        $date       = '2015-01-03';
        $logEntries = $this->logFactory->entries($date);

        foreach ($logEntries as $logEntry) {
            $this->assertLogEntry($date, $logEntry);
        }
    }

    /** @test */
    public function it_can_get_total()
    {
        $this->assertEquals(16, $this->logFactory->total());
    }

    /** @test */
    public function it_can_get_total_by_level()
    {
        foreach (self::$logLevels as $level) {
            $this->assertEquals(2, $this->logFactory->total($level));
        }
    }

    /** @test */
    public function it_can_get_tree()
    {
        $tree = $this->logFactory->tree();

        foreach ($tree as $date => $levels) {
            $this->assertDate($date);

            // TODO: Complete the assertions
        }
    }

    /** @test */
    public function it_can_get_translated_tree()
    {
        $this->app->setLocale('fr');

        $expected = [
            '2015-01-02' => [
                'all'       => ['name' => 'Tous', 'count' => 8],
                'emergency' => ['name' => 'Urgence', 'count' => 1],
                'alert'     => ['name' => 'Alerte', 'count' => 1],
                'critical'  => ['name' => 'Critique', 'count' => 1],
                'error'     => ['name' => 'Erreur', 'count' => 1],
                'warning'   => ['name' => 'Avertissement', 'count' => 1],
                'notice'    => ['name' => 'Notice', 'count' => 1],
                'info'      => ['name' => 'Info', 'count' => 1],
                'debug'     => ['name' => 'Debug', 'count' => 1],
            ],
            '2015-01-01' => [
                'all'       => ['name' => 'Tous', 'count' => 8],
                'emergency' => ['name' => 'Urgence', 'count' => 1],
                'alert'     => ['name' => 'Alerte', 'count' => 1],
                'critical'  => ['name' => 'Critique', 'count' => 1],
                'error'     => ['name' => 'Erreur', 'count' => 1],
                'warning'   => ['name' => 'Avertissement', 'count' => 1],
                'notice'    => ['name' => 'Notice', 'count' => 1],
                'info'      => ['name' => 'Info', 'count' => 1],
                'debug'     => ['name' => 'Debug', 'count' => 1],
            ]
        ];

        $this->assertSame($expected, $tree = $this->logFactory->tree(true));
    }

    /** @test */
    public function it_can_get_menu()
    {
        $menu = $this->logFactory->menu();

        foreach ($menu as $date => $item) {
            $this->assertDate($date);

            // TODO: Complete the assertions
        }
    }

    /** @test */
    public function it_can_get_untranslated_menu()
    {
        $menu = $this->logFactory->menu(false);

        foreach ($menu as $date => $item) {
            $this->assertDate($date);

            // TODO: Complete the assertions
        }
    }

    /** @test */
    public function it_can_get_stats_table()
    {
        $this->assertTable($this->logFactory->statsTable());
    }

    /** @test */
    public function it_can_check_is_not_empty()
    {
        $this->assertFalse($this->logFactory->isEmpty());
    }

    /**
     * @test
     *
     * @expectedException \TobyYan\LogViewer\Exceptions\LogNotFoundException
     */
    public function it_must_throw_a_filesystem_exception()
    {
        $this->logFactory->get('2222-11-11'); // Future FTW
    }

    /** @test */
    public function it_can_set_and_get_pattern()
    {
        $prefix    = 'laravel-';
        $date      = '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]';
        $extension = '.log';

        $this->assertEquals(
            $prefix . $date . $extension,
            $this->logFactory->getPattern()
        );

        $this->logFactory->setPattern($prefix, $date, $extension = '');

        $this->assertEquals(
            $prefix . $date . $extension,
            $this->logFactory->getPattern()
        );

        $this->logFactory->setPattern($prefix = 'laravel-cli-', $date, $extension);

        $this->assertEquals(
            $prefix . $date . $extension,
            $this->logFactory->getPattern()
        );

        $this->logFactory->setPattern($prefix, $date = '[0-9][0-9][0-9][0-9]', $extension);

        $this->assertEquals(
            $prefix . $date . $extension,
            $this->logFactory->getPattern()
        );

        $this->logFactory->setPattern();

        $this->assertEquals(
            'laravel-[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9].log',
            $this->logFactory->getPattern()
        );

        $this->logFactory->setPattern(
            'laravel-', '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]', '.log'
        );

        $this->assertEquals(
            'laravel-[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9].log',
            $this->logFactory->getPattern()
        );
    }
}

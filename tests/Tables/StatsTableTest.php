<?php namespace TobyYan\LogViewer\Tests\Tables;

use TobyYan\LogViewer\Tests\TestCase;
use TobyYan\LogViewer\Tables\StatsTable;

/**
 * Class     StatsTableTest
 *
 * @package  TobyYan\LogViewer\Tests\Tables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class StatsTableTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var StatsTable */
    private $table;

    /** @var array */
    private $rawData;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->table   = new StatsTable(
            $this->rawData = $this->getLogViewerInstance()->stats(),
            $this->getLogLevelsInstance()
        );
    }

    public function tearDown()
    {
        unset($this->table);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(StatsTable::class, $this->table);
    }

    /** @test */
    public function it_can_make_instance()
    {
        $this->table = StatsTable::make(
            $this->getLogViewerInstance()->stats(),
            $this->getLogLevelsInstance()
        );

        $this->assertTable($this->table);
    }

    /** @test */
    public function it_can_get_header()
    {
        $this->assertTableHeader($this->table);
    }

    /** @test */
    public function it_can_get_rows()
    {
        $this->assertTableRows($this->table);
    }

    /** @test */
    public function it_can_get_footer()
    {
        $this->assertTableFooter($this->table);
    }

    /** @test */
    public function it_can_get_raw_data()
    {
        $this->assertEquals(
            $this->rawData,
            $this->table->data()
        );
    }

    /** @test */
    public function it_can_get_totals()
    {
        $totals = $this->table->totals();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $totals);
    }

    /** @test */
    public function it_can_get_json_data_for_chart()
    {
        $json = $this->table->totalsJson();

        $this->assertJson($json);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the LogViewer instance.
     *
     * @return \TobyYan\LogViewer\Contracts\LogViewer
     */
    protected function getLogViewerInstance()
    {
        return $this->app->make(\TobyYan\LogViewer\Contracts\LogViewer::class);
    }

    /**
     * Get the LogLevels instance.
     *
     * @return \TobyYan\LogViewer\Contracts\Utilities\LogLevels
     */
    protected function getLogLevelsInstance()
    {
        return $this->app->make(\TobyYan\LogViewer\Contracts\Utilities\LogLevels::class);
    }
}

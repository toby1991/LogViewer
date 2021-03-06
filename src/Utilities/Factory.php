<?php namespace TobyYan\LogViewer\Utilities;

use TobyYan\LogViewer\Contracts\Utilities\Factory as FactoryContract;
use TobyYan\LogViewer\Contracts\Utilities\Filesystem as FilesystemContract;
use TobyYan\LogViewer\Contracts\Utilities\LogLevels as LogLevelsContract;
use TobyYan\LogViewer\Entities\LogCollection;
use TobyYan\LogViewer\Tables\StatsTable;

/**
 * Class     Factory
 *
 * @package  TobyYan\LogViewer\Utilities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Factory implements FactoryContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The filesystem instance.
     *
     * @var \TobyYan\LogViewer\Contracts\Utilities\Filesystem
     */
    protected $filesystem;

    /**
     * The log levels instance.
     *
     * @var \TobyYan\LogViewer\Contracts\Utilities\LogLevels
     */
    private $levels;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\Utilities\Filesystem  $filesystem
     * @param  \TobyYan\LogViewer\Contracts\Utilities\LogLevels   $levels
     */
    public function __construct(FilesystemContract $filesystem, LogLevelsContract $levels) {
        $this->setFilesystem($filesystem);
        $this->setLevels($levels);
    }

    /* -----------------------------------------------------------------
     |  Getter & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the filesystem instance.
     *
     * @return \TobyYan\LogViewer\Contracts\Utilities\Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Set the filesystem instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\Utilities\Filesystem  $filesystem
     *
     * @return self
     */
    public function setFilesystem(FilesystemContract $filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * Get the log levels instance.
     *
     * @return \TobyYan\LogViewer\Contracts\Utilities\LogLevels
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * Set the log levels instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\Utilities\LogLevels  $levels
     *
     * @return self
     */
    public function setLevels(LogLevelsContract $levels)
    {
        $this->levels = $levels;

        return $this;
    }

    /**
     * Set the log storage path.
     *
     * @param  string  $storagePath
     *
     * @return self
     */
    public function setPath($storagePath)
    {
        $this->filesystem->setPath($storagePath);

        return $this;
    }

    /**
     * Get the log pattern.
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->filesystem->getPattern();
    }

    /**
     * Set the log pattern.
     *
     * @param  string  $date
     * @param  string  $prefix
     * @param  string  $extension
     *
     * @return self
     */
    public function setPattern(
        $prefix    = FilesystemContract::PATTERN_PREFIX,
        $date      = FilesystemContract::PATTERN_DATE,
        $extension = FilesystemContract::PATTERN_EXTENSION
    ) {
        $this->filesystem->setPattern($prefix, $date, $extension);

        return $this;
    }

    /**
     * Get all logs.
     *
     * @return \TobyYan\LogViewer\Entities\LogCollection
     */
    public function logs()
    {
        return LogCollection::make()->setFilesystem($this->filesystem);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all logs (alias).
     *
     * @see logs
     *
     * @return \TobyYan\LogViewer\Entities\LogCollection
     */
    public function all()
    {
        return $this->logs();
    }

    /**
     * Paginate all logs.
     *
     * @param  int  $perPage
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 30)
    {
        return $this->logs()->paginate($perPage);
    }

    /**
     * Get a log by date.
     *
     * @param  string  $date
     *
     * @return \TobyYan\LogViewer\Entities\Log
     */
    public function log($date)
    {
        return $this->logs()->log($date);
    }

    /**
     * Get a log by date (alias).
     *
     * @param  string  $date
     *
     * @return \TobyYan\LogViewer\Entities\Log
     */
    public function get($date)
    {
        return $this->log($date);
    }

    /**
     * Get log entries.
     *
     * @param  string  $date
     * @param  string  $level
     *
     * @return \TobyYan\LogViewer\Entities\LogEntryCollection
     */
    public function entries($date, $level = 'all')
    {
        return $this->logs()->entries($date, $level);
    }

    /**
     * Get logs statistics.
     *
     * @return array
     */
    public function stats()
    {
        return $this->logs()->stats();
    }

    /**
     * Get logs statistics table.
     *
     * @param  string|null  $locale
     *
     * @return \TobyYan\LogViewer\Tables\StatsTable
     */
    public function statsTable($locale = null)
    {
        return StatsTable::make($this->stats(), $this->levels, $locale);
    }

    /**
     * List the log files (dates).
     *
     * @return array
     */
    public function dates()
    {
        return $this->logs()->dates();
    }

    /**
     * Get logs count.
     *
     * @return int
     */
    public function count()
    {
        return $this->logs()->count();
    }

    /**
     * Get total log entries.
     *
     * @param  string  $level
     *
     * @return int
     */
    public function total($level = 'all')
    {
        return $this->logs()->total($level);
    }

    /**
     * Get tree menu.
     *
     * @param  bool  $trans
     *
     * @return array
     */
    public function tree($trans = false)
    {
        return $this->logs()->tree($trans);
    }

    /**
     * Get tree menu.
     *
     * @param  bool  $trans
     *
     * @return array
     */
    public function menu($trans = true)
    {
        return $this->logs()->menu($trans);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the log folder is empty or not.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->logs()->isEmpty();
    }
}

<?php namespace TobyYan\LogViewer\Contracts\Utilities;

use TobyYan\LogViewer\Contracts\Patternable;

/**
 * Interface  Factory
 *
 * @package   TobyYan\LogViewer\Contracts\Utilities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
interface Factory extends Patternable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the filesystem instance.
     *
     * @return \TobyYan\LogViewer\Contracts\Utilities\Filesystem
     */
    public function getFilesystem();

    /**
     * Set the filesystem instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\Utilities\Filesystem  $filesystem
     *
     * @return self
     */
    public function setFilesystem(Filesystem $filesystem);

    /**
     * Get the log levels instance.
     *
     * @return  \TobyYan\LogViewer\Contracts\Utilities\LogLevels  $levels
     */
    public function getLevels();

    /**
     * Set the log levels instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\Utilities\LogLevels  $levels
     *
     * @return self
     */
    public function setLevels(LogLevels $levels);

    /**
     * Set the log storage path.
     *
     * @param  string  $storagePath
     *
     * @return self
     */
    public function setPath($storagePath);

    /**
     * Get all logs.
     *
     * @return \TobyYan\LogViewer\Entities\LogCollection
     */
    public function logs();

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
    public function all();

    /**
     * Paginate all logs.
     *
     * @param  int  $perPage
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 30);

    /**
     * Get a log by date.
     *
     * @param  string  $date
     *
     * @return \TobyYan\LogViewer\Entities\Log
     */
    public function log($date);

    /**
     * Get a log by date (alias).
     *
     * @param  string  $date
     *
     * @return \TobyYan\LogViewer\Entities\Log
     */
    public function get($date);

    /**
     * Get log entries.
     *
     * @param  string  $date
     * @param  string  $level
     *
     * @return \TobyYan\LogViewer\Entities\LogEntryCollection
     */
    public function entries($date, $level = 'all');

    /**
     * List the log files (dates).
     *
     * @return array
     */
    public function dates();

    /**
     * Get logs count.
     *
     * @return int
     */
    public function count();

    /**
     * Get total log entries.
     *
     * @param  string  $level
     *
     * @return int
     */
    public function total($level = 'all');

    /**
     * Get tree menu.
     *
     * @param  bool  $trans
     *
     * @return array
     */
    public function tree($trans = false);

    /**
     * Get tree menu.
     *
     * @param  bool  $trans
     *
     * @return array
     */
    public function menu($trans = true);

    /**
     * Get logs statistics.
     *
     * @return array
     */
    public function stats();

    /**
     * Get logs statistics table.
     *
     * @param  string|null  $locale
     *
     * @return \TobyYan\LogViewer\Tables\StatsTable
     */
    public function statsTable($locale = null);

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the log folder is empty or not.
     *
     * @return bool
     */
    public function isEmpty();
}

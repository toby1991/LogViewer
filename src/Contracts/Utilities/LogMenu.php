<?php namespace TobyYan\LogViewer\Contracts\Utilities;

use TobyYan\LogViewer\Entities\Log;
use Illuminate\Contracts\Config\Repository as ConfigContract;

/**
 * Interface  LogMenu
 *
 * @package   TobyYan\LogViewer\Contracts\Utilities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
interface LogMenu
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the config instance.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     *
     * @return self
     */
    public function setConfig(ConfigContract $config);

    /**
     * Set the log styler instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\Utilities\LogStyler  $styler
     *
     * @return self
     */
    public function setLogStyler(LogStyler $styler);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make log menu.
     *
     * @param  \TobyYan\LogViewer\Entities\Log  $log
     * @param  bool                               $trans
     *
     * @return array
     */
    public function make(Log $log, $trans = true);
}

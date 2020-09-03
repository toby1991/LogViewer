<?php namespace TobyYan\LogViewer\Facades;

use TobyYan\LogViewer\Contracts\Utilities\LogMenu as LogMenuContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     LogMenu
 *
 * @package  TobyYan\LogViewer\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class LogMenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LogMenuContract::class; }
}

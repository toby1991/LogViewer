<?php namespace TobyYan\LogViewer\Facades;

use TobyYan\LogViewer\Contracts\LogViewer as LogViewerContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     LogViewer
 *
 * @package  TobyYan\LogViewer\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class LogViewer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LogViewerContract::class; }
}

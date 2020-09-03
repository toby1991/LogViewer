<?php namespace TobyYan\LogViewer\Facades;

use TobyYan\LogViewer\Contracts\Utilities\LogStyler as LogStylerContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     LogStyler
 *
 * @package  TobyYan\LogViewer\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class LogStyler extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LogStylerContract::class; }
}

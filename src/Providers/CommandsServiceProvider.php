<?php namespace TobyYan\LogViewer\Providers;

use TobyYan\LogViewer\Commands;
use TobyYan\Support\Providers\CommandServiceProvider as ServiceProvider;

/**
 * Class     CommandsServiceProvider
 *
 * @package  TobyYan\LogViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
class CommandsServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        Commands\PublishCommand::class,
        Commands\StatsCommand::class,
        Commands\CheckCommand::class,
    ];
}

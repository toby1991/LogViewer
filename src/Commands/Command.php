<?php namespace TobyYan\LogViewer\Commands;

use TobyYan\LogViewer\Contracts\LogViewer as LogViewerContract;
use TobyYan\Support\Bases\Command as BaseCommand;

/**
 * Class     Command
 *
 * @package  TobyYan\LogViewer\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 * @author   TobyYan <me@tobyan.com>
 */
abstract class Command extends BaseCommand
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var \TobyYan\LogViewer\Contracts\LogViewer */
    protected $logViewer;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create the command instance.
     *
     * @param  \TobyYan\LogViewer\Contracts\LogViewer  $logViewer
     */
    public function __construct(LogViewerContract $logViewer)
    {
        parent::__construct();

        $this->logViewer = $logViewer;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Display LogViewer Logo and Copyrights.
     */
    protected function displayLogViewer()
    {
        // LOGO
        $this->comment('   __                   _                        ');
        $this->comment('  / /  ___   __ _/\   /(_) _____      _____ _ __ ');
        $this->comment(' / /  / _ \ / _` \ \ / / |/ _ \ \ /\ / / _ \ \'__|');
        $this->comment('/ /__| (_) | (_| |\ V /| |  __/\ V  V /  __/ |   ');
        $this->comment('\____/\___/ \__, | \_/ |_|\___| \_/\_/ \___|_|   ');
        $this->comment('            |___/                                ');
        $this->line('');

        // Copyright
        $this->comment('Version '.$this->logViewer->version().' - Created by TobyYan'.chr(169));
        $this->line('');
    }
}

<?php namespace Arcanedev\LogViewer\Entities;

/**
 * Class Log
 * @package Arcanedev\LogViewer\Log
 */
class Log
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The raw log contents.
     *
     * @var string
     */
    protected $raw;

    /**
     * The available log levels.
     *
     * @var string[]
     */
    protected $levels;

    /**
     * The selected log level.
     *
     * @var string
     */
    protected $level;

    /**
     * The processed log data.
     *
     * @var array
     */
    protected $data = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new instance.
     *
     * @param  string    $raw
     * @param  string[]  $levels
     * @param  string    $level
     */
    public function __construct($raw, array $levels, $level = 'all')
    {
        $this->raw    = $raw;
        $this->levels = $levels;
        $this->level  = $level;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the log data.
     *
     * @return array
     */
    public function entries()
    {
        if (empty($this->data)) {
            $this->data = $this->parse();
        }

        return $this->data;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Parse the log.
     *
     * @return array
     */
    private function parse()
    {
        $log = [];

        list($headings, $data) = $this->parseRawData();

        if (is_array($headings)) {
            foreach ($headings as $heading) {
                for ($i = 0, $j = count($heading); $i < $j; $i++) {
                    $this->populateLog($log, $heading, $data, $i);
                }
            };
        }

        unset($headings, $data);

        return array_reverse($log);
    }

    /**
     * Parse raw data
     *
     * @return array
     */
    private function parseRawData()
    {
        $pattern = '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\].*/';
        preg_match_all($pattern, $this->raw, $headings);
        $data    = preg_split($pattern, $this->raw);

        if ($data[0] < 1) {
            $trash = array_shift($data);
            unset($trash);
        }

        return [$headings, $data];
    }

    /**
     * Populate log with entries
     *
     * @param  array  $log
     * @param  array  $heading
     * @param  array  $data
     * @param  int    $i
     */
    private function populateLog(&$log, $heading, $data, $i)
    {
        foreach ($this->levels as $level) {
            if (
                $this->hasSameLevel($level) &&
                $this->hasLogLevel($heading[$i], $level)
            ) {
                $log[] = [
                    'level'  => $level,
                    'header' => $heading[$i],
                    'stack'  => $data[$i]
                ];
            }
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check has same log level
     *
     * @param  string  $level
     *
     * @return bool
     */
    private function hasSameLevel($level)
    {
        return $this->level == $level || $this->level == 'all';
    }

    /**
     * Check heading has log level
     *
     * @param  string  $heading
     * @param  string  $level
     *
     * @return bool
     */
    private function hasLogLevel($heading, $level)
    {
        return (bool) strpos(strtolower($heading), strtolower('.' . $level));
    }
}
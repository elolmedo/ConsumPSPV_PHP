<?php

namespace Yuloh\Expect;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class ConsoleLogger extends AbstractLogger implements LoggerInterface
{
    /**
     * @var resource
     */
    private $stream;

    public function __construct($stream = null)
    {
        $this->stream = $stream ?: fopen('php://stdout', 'w');
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        fwrite($this->stream, $this->formatMessage($this->interpolate($message, $context)));
    }

    /**
     * Formats a message for display on the console.
     *
     * @param  string $message
     * @return string
     */
    private function formatMessage($message)
    {
        $message = str_replace(PHP_EOL, "⏎", $message);
        return '* ' . $message . PHP_EOL;
    }

    /**
     * Interpolates context values into the message placeholders.
     *
     * @param  string $message
     * @param  array  $context
     * @return string
     */
    private function interpolate($message, array $context = array())
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }

        return strtr($message, $replace);
    }
}

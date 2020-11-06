<?php

namespace Yuloh\Expect;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Yuloh\Expect\Exceptions\ProcessTimeoutException;
use Yuloh\Expect\Exceptions\UnexpectedEOFException;
use Yuloh\Expect\Exceptions\ProcessTerminatedException;

class Expect
{
    const EXPECT = 0;
    const SEND   = 1;

    /**
     * The default timeout for expectations.
     */
    const DEFAULT_TIMEOUT = 9999999;

    /**
     * @var string
     */
    private $cmd;

    /**
     * @var string
     */
    private $cwd;

    /**
     * @var resource[]
     */
    private $pipes;

    /**
     * @var resource
     */
    private $process;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param string $cmd
     * @param string $cwd
     * @param LoggerInterface $logger
     */
    private function __construct($cmd, $cwd = null, LoggerInterface $logger = null)
    {
        $this->cmd    = $cmd;
        $this->cwd    = $cwd;
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * Spawn a new instance of Expect for the given command.
     * You can optionally specify a working directory and a
     * PSR compatible logger to use.
     *
     * @param  string $cmd
     * @param  string $cwd
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public static function spawn($cmd, $cwd = null, LoggerInterface $logger = null)
    {
        return new self($cmd, $cwd, $logger);
    }

    /**
     * Register a step to expect the given text to show up on stdout.
     * Expect will block and keep checking the stdout buffer until your expectation
     * shows up or the timeout is reached, whichever comes first.
     *
     * @param  string $output
     * @param  int    $timeout
     * @return $this
     */
    public function expect($output, $timeout = self::DEFAULT_TIMEOUT)
    {
        $this->steps[] = [self::EXPECT, $output, $timeout];

        return $this;
    }

    /**
     * Register a step to send the given text on stdin.
     * A newline is added to each string to simulate pressing enter.
     *
     * @param  string $input
     * @return $this
     */
    public function send($input)
    {
        if (stripos(strrev($input), PHP_EOL) === false) {
            $input = $input . PHP_EOL;
        }

        $this->steps[] = [self::SEND, $input];

        return $this;
    }

    /**
     * Run the process and execute the registered steps.
     * The program will block until the steps are completed or a timeout occurs.
     *
     * @return null
     *
     * @throws \RuntimeException If the process can not be created.
     * @throws \Yuloh\Expect\Exceptions\ProcessTimeoutException    if the process times out.
     * @throws \Yuloh\Expect\Exceptions\UnexpectedEOFException     if an unexpected EOF is found.
     * @throws \Yuloh\Expect\Exceptions\ProcessTerminatedException if the process is terminated
     * before the expectation is met.
     */
    public function run()
    {
        $this->createProcess();

        foreach ($this->steps as $step) {
            if ($step[0] === self::EXPECT) {
                $expectation = $step[1];
                $timeout     = $step[2];
                $this->waitForExpectedResponse($expectation, $timeout);
            } else {
                $input = $step[1];
                $this->sendInput($input);
            }
        }

        $this->closeProcess();
    }

    /**
     * Create the process.
     *
     * @return null
     * @throws \RuntimeException If the process can not be created.
     */
    private function createProcess()
    {
        $descriptorSpec = [
            ['pipe', 'r'], // stdin
            ['pipe', 'w'], // stdout
            ['pipe', 'r']  // stderr
        ];

        $this->process = proc_open($this->cmd, $descriptorSpec, $this->pipes, $this->cwd);

        if (!is_resource($this->process)) {
            throw new \RuntimeException('Could not create the process.');
        }
    }

    /**
     * Close the process.
     *
     * @return null
     */
    private function closeProcess()
    {
        fclose($this->pipes[0]);
        fclose($this->pipes[1]);
        fclose($this->pipes[2]);
        proc_close($this->process);
    }

    /**
     * Wait for the given response to show on stdout.
     *
     * @param  string $expectation The expected output.  Will be glob matched.
     * @return null
     * @throws \Yuloh\Expect\Exceptions\ProcessTimeoutException if the process times out.
     * @throws \Yuloh\Expect\Exceptions\UnexpectedEOFException if an unexpected EOF is found.
     * @throws \Yuloh\Expect\Exceptions\ProcessTerminatedException if the process is terminated
     * before the expectation is met.
     */
    private function waitForExpectedResponse($expectation, $timeout)
    {
        $response           = null;
        $lastLoggedResponse = null;
        $buffer             = '';
        $start              = time();
        stream_set_blocking($this->pipes[1], false);

        while (true) {
            if (time() - $start >= $timeout) {
                throw new ProcessTimeoutException();
            }

            if (feof($this->pipes[1])) {
                throw new UnexpectedEOFException();
            }

            if (!$this->isRunning()) {
                throw new ProcessTerminatedException();
            }

            $buffer .= fread($this->pipes[1], 4096);
            $response = static::trimAnswer($buffer);

            if ($response !== '' && $response !== $lastLoggedResponse) {
                $lastLoggedResponse = $response;
                $this->logger->info("Expected '{$expectation}', got '{$response}'");
            }

            if (fnmatch($expectation, $response)) {
                return;
            }
        }
    }

    /**
     * Send the given input on stdin.
     *
     * @param  string $input
     * @return null
     */
    private function sendInput($input)
    {
        $this->logger->info("Sending '{$input}'");

        fwrite($this->pipes[0], $input);
    }

    /**
     * Returns a string with any newlines trimmed.
     *
     * @param  string $str
     * @return string
     */
    private static function trimAnswer($str)
    {
        return preg_replace('{\r?\n$}D', '', $str);
    }

    /**
     * Determine if the process is running.
     *
     * @return boolean
     */
    private function isRunning()
    {
        if (!is_resource($this->process)) {
            return false;
        }

        $status = proc_get_status($this->process);

        return $status['running'];
    }
}

<?php

use Yuloh\Expect\ConsoleLogger;

class ConsoleLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testLog()
    {
        $stream = fopen('php://temp', 'r+');
        $logger = new ConsoleLogger($stream);

        $logger->info("hello {name}\n", ['name' => 'Matt']);
        rewind($stream);
        $this->assertSame("* hello Matt⏎\n", stream_get_contents($stream));
    }
}

<?php

use Yuloh\Expect\Expect;
use Yuloh\Expect\Exceptions;

class ExpectTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicUsage()
    {
        Expect::spawn('cat')
            ->send('hi')
            ->expect('hi')
            ->send('hola')
            ->expect('hola')
            ->run();
    }

    public function testTimeoutThrowsException()
    {
        $this->setExpectedException(Exceptions\ProcessTimeoutException::class);

        Expect::spawn('cat')
            ->send('hi')
            ->expect('hola', 1)
            ->run();
    }

    public function testKilledProcessThrowsException()
    {
        $this->setExpectedException(Exceptions\ProcessTerminatedException::class);

        Expect::spawn('sleep 2s && kill $$ & while sleep 1; do echo Working; done')
            ->expect('hola')
            ->run();
    }

    public function testEOFThrowsException()
    {
       $this->setExpectedException(Exceptions\UnexpectedEOFException::class);

        Expect::spawn('exec 1>&- && sleep 1s && kill $$')
            ->expect('hola')
            ->run();
    }
}

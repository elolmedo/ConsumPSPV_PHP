# Expect

This package is a pure PHP alternative to [expect](https://en.wikipedia.org/wiki/Expect), the Unix tool.  This package doesn't depend on the [PECL package](https://pecl.php.net/package/expect) either.

Expect lets you script interactions with interactive terminal applications.

## Why?

I wrote this because I wrote an interactive CLI program and needed to write automated tests for it.  Apparently people use the real expect for scripting ftp and telnet workflows, so I guess you could use it for that too.

## Installation

```bash
composer require yuloh/expect
```

## API

Note: all methods return $this for fluent chaining.

```php
spawn(string $cmd, string $cwd = null, LoggerInterface $logger = null)
```

Spawn a new instance of expect for the given command. You can optionally specify a working directory and a PSR compatible logger to use.

```php
expect(string $output, $timeout = 9999999)
```

Expect the given text to show up on stdout.  Expect will block and keep checking the stdout buffer until your expectation shows up or the timeout is reached, whichever comes first.

You can use [shell wildcards](http://tldp.org/LDP/GNU-Linux-Tools-Summary/html/x11655.htm) to match parts of output.

```php
send(string $msg)
```

Send the given text on stdin.  A newline is added to each string to simulate pressing enter.  If you want to just send enter you can do `send(PHP_EOL)`

## Examples

### Simple Example

This example opens `cat` without any arguments, which will simply echo back everything you type to it.

```php
Yuloh\Expect\Expect::spawn('cat')
    ->send('hi')
    ->expect('hi')
    ->send('yo')
    ->expect('yo')
    ->run();
```

### Npm init

This example demonstrates creating a new package.json with npm.  Globs are used to match the expectations so we don't need to type them exactly.

```php
Yuloh\Expect\Expect::spawn('npm init')
    ->expect('*name:*')
    ->send('package')
    ->expect('version*')
    ->send('1.0.0')
    ->expect('description*')
    ->send('awesome')
    ->expect('entry point*')
    ->send('index.js')
    ->expect('test command*')
    ->send('test')
    ->expect('git repository*')
    ->send('yuloh/expect')
    ->expect('keywords*')
    ->send('awesome')
    ->expect('author*')
    ->send('matt')
    ->expect('license*')
    ->send('ISC')
    ->expect('*')
    ->send('yes')
    ->run();
```

## Logging

You will probably need logging to figure out what is happening.  Expect accepts a PSR compatible logger during instantiation.  You can use the `Yuloh\Expect\ConsoleLogger` for readable output while writing scripts or debugging.  For example, instantiating Expect like this:

```php
Yuloh\Expect\Expect::spawn('cat', getcwd(), new Yuloh\Expect\ConsoleLogger())
    ->send('hi')
    ->expect('hi')
    ->run();
```

...would output this to the terminal:

```bash
* Sending 'hi⏎'
* Expected 'hi', got 'hi'
```

## Exceptions

There are a couple of things that can go wrong while running your process:

- The process can fail to start.
- The process can timeout before your expectation happens.
- The process can halt unexpectedly.
- The process can send EOF before your expectation happens.

If the process fails to start, a `RuntimeException` is thrown.  The [`Yuloh\Expect\Exceptions` namespace](src/Exceptions) contains exceptions for the other three scenarios.  All of the exceptions extend `Yuloh\Expect\FailedExpectationException` so you can just catch that one if you like.

## Buffering

Some programs like Composer buffer the output so Expect won't work unless you unbuffer the output.  The easiest way to do this is probably using [script](https://en.wikipedia.org/wiki/Script_(Unix)).  Modify your command to pipe through script like this:

```bash
# FreeBSD/Darwin (Mac OSX)
script -q /dev/null {your-command}
# Linux
script -c {your-command} /dev/null
```

Then you can pass that in to Expect:

```php
Expect::spawn('script -q /dev/null ssh localhost')
    ->expect('*password:')
    ->send('hunter 2')
    ->run();
```

You will probably need to modify expectations when using script, since what you type will show up in stdout too.

## Testing

```bash
composer test
composer cs
```

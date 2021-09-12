<?php
/*
 * This file is part of Aplus Framework One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\One;

/**
 * Class OneTest.
 *
 * @runTestsInSeparateProcesses
 */
final class OneTest extends TestCase
{
    public function testIndex() : void
    {
        $response = $this->runOne('http://domain.tld');
        self::assertSame(200, $response['code']);
        self::assertStringContainsString('One', $response['body']);
    }

    public function testNotFound() : void
    {
        $response = $this->runOne('http://domain.tld/wakawaka');
        self::assertSame(404, $response['code']);
        self::assertStringContainsString('Route not found', $response['body']);
    }
}

<?php
/*
 * This file is part of Aplus Framework One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\One;

use Framework\MVC\App;

/**
 * Class OneTest.
 *
 * @runTestsInSeparateProcesses
 */
final class OneTest extends TestCase
{
    protected string $baseUrl = 'http://domain.tld/';

    public function testConfigs() : void
    {
        $this->runOne($this->baseUrl);
        $configs = App::config()->get('exceptions');
        self::assertArrayHasKey('logger_instance', $configs);
        $configs = App::config()->get('logger');
        self::assertArrayHasKey('directory', $configs);
        self::assertArrayHasKey('level', $configs);
    }

    public function testIndex() : void
    {
        $response = $this->runOne($this->baseUrl);
        self::assertSame(200, $response['code']);
        self::assertStringContainsString('One', $response['body']);
    }

    public function testNotFound() : void
    {
        $response = $this->runOne($this->baseUrl . 'wakawaka');
        self::assertSame(404, $response['code']);
        self::assertStringContainsString('Route not found', $response['body']);
    }
}

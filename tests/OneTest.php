<?php
/*
 * This file is part of One Project.
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
    public function testConfigs() : void
    {
        $this->runOne();
        $configs = App::config()->get('exceptionHandler');
        self::assertArrayHasKey('logger_instance', $configs);
        $configs = App::config()->get('logger');
        self::assertArrayHasKey('destination', $configs);
        self::assertArrayHasKey('level', $configs);
    }

    public function testIndex() : void
    {
        $response = $this->runOne();
        self::assertSame(200, $response['code']);
        self::assertStringContainsString('One', $response['body']);
    }

    public function testNotFound() : void
    {
        $response = $this->runOne('/wakawaka');
        self::assertSame(404, $response['code']);
        self::assertStringContainsString('Route not found', $response['body']);
    }
}

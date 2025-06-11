<?php
/*
 * This file is part of One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\One;

use Framework\MVC\App;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;

/**
 * Class OneTest.
 */
#[RunTestsInSeparateProcesses]
final class OneTest extends TestCase
{
    protected string $baseUrl = 'http://domain.tld/';

    public function testConfigs() : void
    {
        $this->runOne($this->baseUrl);
        $configs = App::config()->get('exceptionHandler');
        self::assertArrayHasKey('logger_instance', $configs);
        $configs = App::config()->get('logger');
        self::assertArrayHasKey('destination', $configs);
        self::assertArrayHasKey('level', $configs);
    }

    public function testIndex() : void
    {
        $response = $this->runOne($this->baseUrl);
        self::assertSame(200, $response['code']);
        self::assertStringContainsString('One', $response['body']);
    }

    public function testAbout() : void
    {
        $response = $this->runOne($this->baseUrl . 'about');
        self::assertSame(200, $response['code']);
        self::assertStringContainsString('<strong>me</strong>', $response['body']);
        self::assertSame('about', App::router()->getMatchedRoute()->getName());
    }

    public function testNotFound() : void
    {
        $response = $this->runOne($this->baseUrl . 'wakawaka');
        self::assertSame(404, $response['code']);
        self::assertStringContainsString('Route not found', $response['body']);
    }
}

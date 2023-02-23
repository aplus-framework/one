<?php declare(strict_types=1);
/*
 * This file is part of One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\One;

use Framework\HTTP\URL;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class TestCase.
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected string $baseUrl = 'https://localhost:8080/';

    /**
     * Run the One file.
     *
     * @param string|URL|null $url
     * @param string $method
     * @param array<string,string> $headers
     *
     * @return array<string,mixed>
     */
    #[ArrayShape(['code' => 'int', 'headers' => 'array', 'body' => 'string'])]
    protected function runOne(
        URL | string $url = null,
        string $method = 'GET',
        array $headers = []
    ) : array {
        $this->baseUrl = \rtrim($this->baseUrl, '/') . '/';
        if ($url === null) {
            $url = $this->baseUrl;
        }
        if (\is_string($url) && \str_starts_with($url, '/')) {
            $url = $this->baseUrl . \ltrim($url, '/');
        }
        if ( ! $url instanceof URL) {
            $url = new URL($url);
        }
        if ($url->getScheme() === 'https') {
            $_SERVER['HTTPS'] = 'on';
        }
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $url->getPath();
        $_SERVER['HTTP_HOST'] = $url->getHost();
        foreach ($headers as $name => $value) {
            $name = \strtr($name, ['-' => '_']);
            $name = \strtoupper($name);
            $_SERVER['HTTP_' . $name] = $value;
        }
        \ob_start();
        require __DIR__ . '/../public/index.php';
        $body = (string) \ob_get_clean();
        return [
            'code' => (int) \http_response_code(),
            'headers' => \headers_list(),
            'body' => $body,
        ];
    }
}

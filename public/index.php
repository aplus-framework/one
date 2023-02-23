<?php
/*
 * This file is part of One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (class_exists(Composer\Autoload\ClassLoader::class, false) === false
    && is_file(__DIR__ . '/../vendor/autoload.php')
) {
    require __DIR__ . '/../vendor/autoload.php';
}

use Framework\Log\LogLevel;
use Framework\MVC\App;
use Framework\Routing\RouteCollection;
use Framework\Routing\Router;

define('ENVIRONMENT', $_SERVER['ENVIRONMENT'] ?? 'production');

(new App([
    'exceptionHandler' => [
        'default' => [
            'environment' => ENVIRONMENT,
            'initialize' => true,
            'logger_instance' => 'default',
        ],
    ],
    'logger' => [
        'default' => [
            'destination' => __DIR__ . '/../storage/logs',
            'level' => LogLevel::ERROR,
        ],
    ],
    'request' => [
        'default' => [
            'allowed_hosts' => [
                'localhost:8080',
            ],
            'force_https' => ENVIRONMENT !== 'development',
        ],
    ],
    'response' => [
        'default' => [
            'auto_etag' => true,
        ],
    ],
    'router' => [
        'default' => [
            'auto_methods' => true,
            'auto_options' => true,
            'callback' => static function (Router $router) : void {
                $router->serve(null, static function (RouteCollection $routes) : void {
                    $routes->get('/', static function () : array {
                        return [
                            'message' => 'I am the One! You found me.',
                        ];
                    });
                    $routes->notFound(static fn () : array => [
                        'message' => 'Route not found.',
                    ]);
                });
            },
        ],
    ],
], ENVIRONMENT === 'development'))->runHttp();

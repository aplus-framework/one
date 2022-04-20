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

use Framework\Debug\ExceptionHandler;
use Framework\Log\LogLevel;
use Framework\MVC\App;
use Framework\Routing\RouteCollection;

$app = new App([
    'exceptionHandler' => [
        'default' => [
            'environment' => $_SERVER['ENVIRONMENT'] ?? ExceptionHandler::PRODUCTION,
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
]);
App::router()->serve(null, static function (RouteCollection $routes) : void {
    $routes->get('/', static function () : array {
        return [
            'message' => 'I am the One! You found me.',
        ];
    });
    $routes->notFound(static fn () : array => [
        'message' => 'Route not found.',
    ]);
});
$app->runHttp();

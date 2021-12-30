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

use Framework\Config\Config;
use Framework\Log\Logger;
use Framework\MVC\App;
use Framework\Routing\RouteCollection;

$app = new App(new Config([
    'exceptions' => [
        'default' => [
            'initialize' => true,
            'logger_instance' => 'default',
        ],
    ],
    'logger' => [
        'default' => [
            'directory' => __DIR__ . '/../storage/logs',
            'level' => Logger::ERROR,
        ],
    ],
]));
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

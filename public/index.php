<?php declare(strict_types=1);
/*
 * This file is part of One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
}

/**
 * The user guide for this project is available at:
 *
 * @see https://docs.aplus-framework.com/guides/projects/one/index.html
 */

use Framework\Log\LogLevel;
use Framework\MVC\App;
use Framework\Routing\RouteCollection;

define('ENVIRONMENT', $_SERVER['ENVIRONMENT'] ?? 'production');
define('IS_DEV', ENVIRONMENT === 'development');

/**
 * For details on how to set configs visit:
 *
 * @see https://docs.aplus-framework.com/guides/libraries/mvc/index.html#services
 */
$app = new App([
    'exceptionHandler' => [
        'default' => [
            'environment' => ENVIRONMENT,
            'logger_instance' => 'default',
        ],
    ],
    'logger' => [
        'default' => [
            'destination' => __DIR__ . '/../storage/logs',
            'level' => LogLevel::ERROR,
        ],
    ],
], IS_DEV);

/**
 * For details on how to add routes visit:
 *
 * @see https://docs.aplus-framework.com/guides/libraries/routing/index.html#route-collection
 */
App::router()->serve(null, static function (RouteCollection $routes) : void {
    $routes->get('/', static function () : array {
        return [
            'message' => 'I am the One! You found me.',
        ];
    });
    $routes->get('/about', static function () : string {
        return 'Do you want to know about <strong>me</strong>?';
    }, 'about');
    $routes->notFound(static fn () : array => [
        'message' => 'Route not found.',
    ]);
});

/**
 * For details on how to run the app visit:
 *
 * @see https://docs.aplus-framework.com/guides/libraries/mvc/index.html#running
 */
$app->runHttp();

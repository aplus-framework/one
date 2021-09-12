<?php
/*
 * This file is part of Aplus Framework One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
}

use Framework\Config\Config;
use Framework\MVC\App;
use Framework\Routing\RouteCollection;

(new App(new Config(null)))->runHttp(static function () : void {
    App::router()->serve(null, static function (RouteCollection $routes) : void {
        $routes->get('/', static function () : array {
            return [
                'message' => 'I am the One! You found me.',
            ];
        });
        $routes->notFound(static function () : array {
            return [
                'message' => 'Route not found.',
            ];
        });
    });
});

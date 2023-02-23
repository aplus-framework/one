<?php
/*
 * This file is part of One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPSTORM_META;

registerArgumentsSet(
    'methods',
    \Framework\HTTP\Method::CONNECT,
    \Framework\HTTP\Method::DELETE,
    \Framework\HTTP\Method::GET,
    \Framework\HTTP\Method::HEAD,
    \Framework\HTTP\Method::OPTIONS,
    \Framework\HTTP\Method::PATCH,
    \Framework\HTTP\Method::POST,
    \Framework\HTTP\Method::PUT,
    \Framework\HTTP\Method::TRACE,
    'CONNECT',
    'DELETE',
    'GET',
    'HEAD',
    'OPTIONS',
    'PATCH',
    'POST',
    'PUT',
    'TRACE',
);

expectedArguments(
    \Tests\One\TestCase::runOne(),
    1,
    argumentsSet('methods')
);

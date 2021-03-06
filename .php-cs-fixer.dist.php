<?php declare(strict_types=1);
/*
 * This file is part of One Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Framework\CodingStandard\Config;
use Framework\CodingStandard\Finder;

return (new Config())->setDefaultHeaderComment(
    'One Project',
    '' // [fullname] [<email>]
)->setFinder(
    Finder::create()->in(__DIR__)
);

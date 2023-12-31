<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

if (str_starts_with($_SERVER['REQUEST_URI'], '/typo3')) {
    $_SERVER['SCRIPT_FILENAME'] = str_replace('index.php', 'typo3/index.php', $_SERVER['SCRIPT_FILENAME']);
    $_SERVER['PHP_SELF'] = str_replace('index.php', 'typo3/index.php', $_SERVER['PHP_SELF']);
    $_SERVER['PATH_INFO'] = substr($_SERVER['PATH_INFO'], 6);
    $_SERVER['SCRIPT_NAME'] = '/typo3/index.php';
    require './typo3/index.php';
    die();
}

// Set up the application for the frontend
call_user_func(static function () {
    $classLoader = require dirname(__DIR__).'/vendor/autoload.php';
    \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::run(0, \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::REQUESTTYPE_FE);
    \TYPO3\CMS\Core\Core\Bootstrap::init($classLoader)->get(\TYPO3\CMS\Frontend\Http\Application::class)->run();
});

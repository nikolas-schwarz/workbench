<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * Workbench 
 *
 * My personal Project foundation build with 
 * psr-middleware, psr-events, plugin and smarty support.
 *
 * PHP version 7.4 or higher
 *
 * LICENSE: MIT
 *
 * @package    Workbench
 * @author     Nikolas Schwarz <nikolas.schwarz@evolut.solutions>
 * @copyright  2021 Nikolas Schwarz
 * @license    https://raw.githubusercontent.com/nikolas-schwarz/workbench/main/LICENSE  MIT
 * @version    1.0.0
 * @link       https://github.com/nikolas-schwarz/workbench
 */

use Workbench\App;

$app = new App();

// Testing
print_r($app->getVersion());
print_r($app->getName());
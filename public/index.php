<?php declare(strict_types=1);

/**
 * Workbench 
 *
 * My personal Project foundation build with 
 * psr-standards, extensions and template support.
 * 
 * This framework is mainly based on a bunch of patterns that
 * helps building a solid foundation for my projects. The main
 * idea is, that every project is a collection of extensions, 
 * which form the resulting website, blog, web application. 
 * All with extensibility from the start in mind. This may help
 * you to collaborate with others on your project, or maybe it
 * helps you to understand some common patterns or solutions.
 *
 * PHP version 8.0 or higher
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

require __DIR__ . '/../vendor/autoload.php';

// use the workbench namespace
use Workbench\Core\App;
use Workbench\Manager\ExtensionManager;

// create a new application
$app = new App();

// register the extension manager singleton
$app->registerManager(ExtensionManager::getInstance());

// run the application
$app->run();
<?php declare(strict_types=1);

namespace Workbench\Manager;

use Workbench\Core\System;
use Workbench\Core\Pattern\Singleton;

/**
 * ExtensionManager 
 *
 * Manager class to load and unload extensions on a low level.
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
final class ExtensionManager extends Singleton {
    // define the default meta values for the extension.
    private $loader;
    private $extension;
    
    // implement all abstract methods
    protected function initializeSingelton() {
        $this->loader = require System::getRootDir() . '/vendor/autoload.php';
    }

    // getter for the extension meta data as property

    // setter for the extension meta data as property

    // updater for the extension meta data as property
    function updateExtensionBaseDir() {
        $this->baseDir = System::getExtensionsDir() . '/' . ucfirst($this->name);
    }

    //TODO: implement the get all folders from extension path and load the extension 

    // helper functions
    function loadPsr4Namespaces($namespace, $paths) {
        // run the loader function
        $this->loader->setPsr4($namespace, $paths);
    }

    function getPsr4Namespaces() {
        return $this->loader->getPrefixesPsr4();
    }

    // static helper functions
    static function autoloadNamespaces($namespace, $paths) {
        // create a local instance
        $extMgr = ExtensionManager::getInstance();
        // load the path into the namespace
        $extMgr->loadPsr4Namespaces($namespace, $paths);
    }
}
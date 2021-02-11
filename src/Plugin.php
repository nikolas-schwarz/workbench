<?php declare(strict_types=1);

namespace Workbench;

use Workbench\Core\System;

/**
 * Plugin 
 *
 * Abstract class for a plugin.
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

abstract class Plugin {
    // define the default meta values for the plugin.
    protected string $version = 'dev-1.0.0';
    protected string $name = 'plugin';
    protected string $baseDir = __DIR__;
    protected $config = array();
    protected $autoload = array();

    // constructor
    function __construct() {
        // load the base directory of the current plugin implementation
        $this->baseDir = System::getFolderFromClassInfo($this);
        // load the composer.json file in to retrive the latest version.
        $composerJson = System::getJsonFileAsArray($this->baseDir . '/composer.json');
        // check if the composer.json is correctly converted to an array.
        if($composerJson) {
            // than save the current version from the composer.json
            $this->version = $composerJson["version"];
            // and save the current name from the composer.json
            $this->name = explode('/', $composerJson["name"])[1];
            // save the current subclasses from the composer.json
            $this->autoload = $composerJson["autoload"]["psr-4"];
            // save the current configuration from the extra section of the composer.json
            $this->config = $composerJson["extra"]["config"];
        }
        // check if the autoload property isn't empty
        if(!empty($this->autoload)) {
            // create composer loader
            $loader = require __DIR__ . '/../vendor/autoload.php';
            // load all entries from the autoload
            foreach ($this->autoload as $namespace => $path) {
                $loader->setPsr4($namespace, $this->baseDir . '/' . $path);
            }
        }
    }

    // getter for the plugin meta data
    function getVersion() {
        return $this->version;
    }

    function getName() {
        return $this->name;
    }

    function getConfig() {
        return $this->config;
    }

    function getPluginBaseDir() {
        return $this->pluginBaseDir;
    }
}
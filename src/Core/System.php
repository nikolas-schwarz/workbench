<?php declare(strict_types=1);

namespace Workbench\Core;

/**
 * System 
 *
 * Helper functions for the underlaying system.
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

class System {
    // define the default meta values for system


    // constructor
    function __construct() {
        // currently nothing to do
    }

    static function getRootDir():string {
        return dirname(dirname(dirname(__FILE__)));
    }

    static function getExtensionsDir():string {
        return System::getRootDir() . '/extensions';
    }

    static function getThemesDir():string {
        return System::getRootDir() . '/themes';
    }

    static function getFolderFromClassInfo(object $class):string {
        // load the class info of the current plugin implementation
        $class_info = new \ReflectionClass($class);
        // load the base directory of the current plugin implementation
        return dirname($class_info->getFileName()) . '/';
    }

    static function getJsonFile(string $fileUri, bool $asArray = false):mixed {
        return json_decode(file_get_contents($fileUri), $asArray);
    }

    static function getJsonFileAsObject(string $fileUri):mixed {
        return System::getJsonFile($fileUri);
    }

    static function getJsonFileAsArray(string $fileUri):mixed {
        return System::getJsonFile($fileUri, true);
    }
}
<?php declare(strict_types=1);

namespace Workbench\Core\Pattern;

/**
 * Singleton 
 *
 * Singleton Pattern class.
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
abstract class Singleton {
    // singleton instance
    private static ?Singleton $instance = null;

    // gets the instance via lazy initialization (created on first usage)
    public static function getInstance(): static
    {
        // check if the instance isn't already initialized
        if (static::$instance === null) static::$instance = new static();
        // return the instance
        return static::$instance;
    }

    // is not allowed to call from outside to prevent from creating multiple instances,
    // to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
    private function __construct() {
        // call the abstract initialization function
        $this->initializeSingelton();
    }

    // prevent the instance from being cloned (which would create a second instance of it)
    private function __clone() {
    }
    

    // prevent from being serialized (which would create a second instance of it)
    public function __sleep() {
        return NULL;
    }

    // prevent from being unserialized (which would create a second instance of it)
    public function __wakeup() {
    }

    abstract protected function initializeSingelton();
}
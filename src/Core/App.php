<?php declare(strict_types=1);

namespace Workbench\Core;

/**
 * App 
 *
 * Main entry point for the application.
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
class App {
    // define the default meta values for application.
    protected string $version = 'dev-1.0.0';
    protected string $name = 'workbench';
    protected $bootstrapConfig = array();
    protected $extensionsConfig = array();
    protected $config = array();
    protected $hooks = array();

    // constructor
    function __construct() {
        // load the composer.json file in to retrive the latest version.
        $composerJson = System::getJsonFileAsArray(System::getRootDir() . '/composer.json');
        // check if the composer.json is correctly converted to an array.
        if($composerJson) {
            // than save the current version from the composer.json
            $this->version = $composerJson["version"];
            // and save the current name from the composer.json
            $this->name = explode('/', $composerJson["name"])[1];
            // save the current configuration from the extra section of the composer.json
            $this->bootstrapConfig = $composerJson["extra"]["workbench"];
            // check if the main composer.json contains a extensions field in the extra section
            if(isset($composerJson["extra"]["extensions"])) {
                // Save the current extension configuration from the extra section of the composer.json
                $this->extensionsConfig = $composerJson["extra"]["extensions"];
            }

            // it is possible to retrive even more infos from the composer.json 
            // so thats the reason to load the file at the contruction time of our application
        }
    }

    // getter for the application meta data
    function getVersion() {
        return $this->version;
    }

    function getName() {
        return $this->name;
    }


    protected function loadConfiguration() {
        //TODO
        var_dump('TODO: load configuration');
    }

    protected function loadExtensions() {
        //TODO
        var_dump('TODO: load extensions');
    }

    protected function bootstrap() {
        //TODO
        var_dump('TODO: bootstrap application');
        // load the configuration
        $this->loadConfiguration();
        // load the extensions
        $this->loadExtensions();
    }

    protected function execute() {
        //TODO
        var_dump('TODO: execute application');
    }

    function registerManager($instance) {
        // TODO: check what instance of the manager this is and save it to the property
    }

    function run() {
        // bootstrap the application
        $this->bootstrap();
        // execute the application
        $this->execute();

        //TODO
        var_dump('TODO: run application');
    }
}
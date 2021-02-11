<?php declare(strict_types=1);

namespace Workbench\Core;

use Workbench\Manager\ExtensionManager;

/**
 * Extension 
 *
 * Extension class.
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
class Extension {
    // define the default meta values for the extension.
    private ?string $name;
    private ?string $vendor;
    private ?string $baseDir;
    private ?bool $enabled;
    
    private ?array $config;
    private ?array $autoload;

    // constructor
    private function __construct(array $config = array()) {
        // check if the config is not empty
        if(!empty($config)) {
            // save the config into the property
            $this->config = $config;
            // save the vendor into the property
            $this->vendor = explode('/', $config["name"])[0];
            // save the name into the property
            $this->name = explode('/', $config["name"])[1];
            // save the enabled state into the property
            $this->enabled = $config['extra']['config']['enabled'];
            // save the autoload init the property
            $this->autoload = $config["autoload"]["psr-4"];
            // save the base directory into the property
            $this->baseDir = System::getExtensionsDir() . '/' . ucfirst($this->name);
            // check if the autoload property isn't empty and the extension is enabled
            if(!empty($this->autoload) && $this->enabled === true) {
                // register the namespaces in autoload property
                $this->doAutoload();
            }
        } else {
            throw new \InvalidArgumentException("Can't create Extension from empty config array!");
        }
    }

    // static creator functions
    public static function fromData(string $vendor, string $name, string $version, bool $enabled = false, string $description = "", string $homepage = "", string $readme = "", string $type = "project", string $license = "", array $authors = array(), array $autoload = array(), array $path = array()): static {
        // check if the minimal data is set
        if(!static::checkIfStringIsValid($vendor) || !static::checkIfStringIsValid($name) || !static::checkIfStringIsValid($version)) {
            throw new \InvalidArgumentException("Can't create Extension from empty data!");
        }
        // return the new instance
        return new static(array(
            "name" => $vendor . "/" . $name, 
            "description" => $description,
            "type" => $type,
            "homepage" => $homepage,
            "readme" => $readme,
            "version" => $version,
            "license" => $license,
            "config" => array(
                "sort-packages" => true
            ),
            "authors" => $authors,
            "require" => array(
                "php" => "^8.0"
            ),
            "autoload" => array(
                "psr-4" => $autoload
            ), 
            "extra" => array(
                "config" => array(
                    "enabled" => $enabled,
                    "path" => $path
                )
            )
        ));
    }

    public static function fromJson(string $json): static {
        // check if the json is set
        if(!static::checkIfStringIsValid($json)) {
            throw new \InvalidArgumentException("Can't create Extension from empty json!");
        }
        // return the new instance created from the json string
        return new static(json_decode(str_replace('\\', '\\\\', $json), true));
    }

    public static function fromJsonFile(string $fileUri): static {
        // check if the file uri is set
        if(!static::checkIfStringIsValid($fileUri)) {
            throw new \InvalidArgumentException("Can't create Extension from empty file uri!");
        }
        // return the new instance created from the json in the file uri
        return new static(System::getJsonFileAsArray($fileUri));
    }

    // getter for the extension meta data as property
    function getVendor(): string {
        return $this->vendor;
    }
    function getName(): string {
        return $this->name;
    }
    function getEnabled(): bool {
        return $this->enabled;
    }
    function getConfig(): array {
        return $this->config;
    }
    function getExtensionBaseDir(): string {
        return $this->baseDir;
    }

    // setter for the extension meta data as property
    function setVendor(string $vendor) {
        $this->vendor = $vendor;
    }
    function setName(string $name) {
        $this->name = $name;
    }
    function setEnabled(bool $enabled) {
        $this->enabled = $enabled;
    }

    // updater for the extension meta data as property
    function updateExtensionBaseDir() {
        $this->baseDir = System::getExtensionsDir() . '/' . ucfirst($this->name);
    } 

    // getter for the extension meta data inside the config array
    function getVersion(): string {
        return $this->config['version'];
    }
    function getDescription(): string {
        return $this->config['description'];
    }

    // public helper functions
    function enable(): bool {
        // register the namespaces in autoload property
        $this->doAutoload();
        // set the extension property to enabled
        return $this->enabled = true;
    }

    function disable(): bool {
        // set the extension property to disabled
        return $this->enabled = false;
    }

    // protected helper functions
    protected function doAutoload() {
        // check if autoload isn't empty and load in the new classnames
        if(!empty($this->autoload)) {
            // load all entries from the autoload
            foreach ($this->autoload as $namespace => $path) {
                // load the namespace via the helper function from extension manager
                ExtensionManager::autoloadNamespaces($namespace, $this->baseDir . '/' . $path);
            }
        }
    }

    // static helper functions
    static function checkIfStringIsValid(string $value):bool {
        return (isset($value) && is_string($value) && strlen(trim($value)) !== 0 && !ctype_space($value));
    }

}
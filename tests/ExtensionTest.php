<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Workbench\Core\Extension;
use Workbench\Core\System;

final class ExtensionTest extends TestCase
{
    public function testCanBeCreatedFromData(): void {
        $this->assertInstanceOf(
            Extension::class,
            Extension::fromData(
                vendor: "workbench-plugin",
                name: "test", 
                description: "TestExtension to test the function Extension:fromData.",
                homepage: "https://www.example.com",
                readme: "https://www.example.com/readme.html",
                type: "project",
                version: "dev-1.0.0",
                license: "MIT",
                enabled: false,
                authors: array(
                    array(
                        "name" => "Nikolas Schwarz",
                        "email" => "nikolas.schwarz@evolut.solutions"
                    )
                ),
                autoload: array(
                    "Workbench\\Extensions\\Test\\Controller\\" => "Classes/Controller/",
                    "Workbench\\Extensions\\Test\\Views\\" => "Classes/Views/"
                ),
                path: array(
                    "/extension/test/" => "Workbench\\Extensions\\Test\\Controller\\HelloWorldController::IndexAction",
                    "/extension/test2/" => "HelloWorldController::IndexAction"
                )
            )
        );
    }

    public function testCanBeCreatedFromJson(): void {
        $this->assertInstanceOf(
            Extension::class,
            Extension::fromJson('{
                "name": "workbench-plugin/example",
                "description": "Example Plugin for the plugin system of the workbench framework.",
                "type": "project",
                "homepage": "https://github.com/nikolas-schwarz/workbench",
                "readme": "https://github.com/nikolas-schwarz/workbench/blob/main/README.md",
                "version": "dev-1.0.0",
                "license": "MIT",
                "config": {
                    "sort-packages": true
                },
                "authors": [
                    {
                        "name": "Nikolas Schwarz",
                        "email": "nikolas.schwarz@evolut.solutions"
                    }
                ],
                "require": {
                    "php": "^8.0"
                },
                "autoload": {
                    "psr-4": {
                        "Workbench\\Extensions\\Example\\Controller\\": "Classes/Controller/",
                        "Workbench\\Extensions\\Example\\Views\\": "Classes/Views/"
                    }
                },
                "extra": {
                    "config": {
                        "enabled": false,
                        "path": {
                            "/extension/hello2/world/": "Workbench\\Extensions\\Example\\Controller\\HelloWorldController::IndexAction",
                            "/extension/hello2/world2/": "HelloWorldController::IndexAction"
                        }
                    }
                }
            }')
        );
    }

    public function testCanBeCreatedFromJsonFile(): void {
        $this->assertInstanceOf(
            Extension::class,
            Extension::fromJsonFile(System::getExtensionsDir() . '/Example/composer.json')
        );
    }

    public function testCannotBeCreatedWithoutData(): void {
        $this->expectException(InvalidArgumentException::class);
        Extension::fromData('', '', '');
    }

    public function testCannotBeCreatedWithoutJson(): void {
        $this->expectException(InvalidArgumentException::class);
        Extension::fromJson('{}');
    }

    public function testCannotBeCreatedWithoutJsonFile(): void {
        $this->expectException(InvalidArgumentException::class);
        Extension::fromJsonFile('');
    }

    // public function testCanBeUsedAsString(): void
    // {
    //     $this->assertEquals(
    //         'user@example.com',
    //         Email::fromString('user@example.com')
    //     );
    // }
}
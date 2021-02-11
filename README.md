# workbench
My personal Project foundation build with psr-standards, extensions and template support.

## Idea
This framework is mainly based on a bunch of patterns that helps building a solid foundation for my projects. The main idea is, that every project is a collection of extensions, which form the resulting website, blog, web application. All with extensibility from the start in mind. This may help you to collaborate with others on your project, or maybe it helps you to understand some common patterns or solutions.

## Research Material
For better understanding, I will list all patterns used in this project. If you wand to learn more about a specific pattern and how to use it in php, I offer you this helpfull link to a collection of patterns, explained in detail and by using php code:

https://designpatternsphp.readthedocs.io/en/latest/README.html

### Used patterns
1. Singletons - https://designpatternsphp.readthedocs.io/en/latest/Creational/Singleton/README.html <br> `The current implementation of the Extension Manager is using the singleton pattern, to make sure we only create on managing instance of the extension manager.`
2. TODO: Abstract Factory, Builder, Dependency Injection, Fluent Interface - to name a few.
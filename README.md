# PatternLibraryBuilder
> Library that provides an elegant and easy way to develop a pattern library for your front-end components

## Requirements
PHP >= 7.1</br>

## Installation
The easiest way to install this bundle is using [Composer][1]
```bash
$ composer require lin3s/pattern-library-builder
```

## Documentation
All the documentation is stored in the `docs` folder.

[Show me the docs!](PatternLibraryBuilder/docs/index.md)

## Tests
This library is completely tested by **[PHPSpec][2], SpecBDD framework for PHP**.

Run the following command to launch tests:
```bash
$ vendor/bin/phpspec run -fpretty
```
Also, you can easily start a simple application to test the features that the bundle provides.
```bash
$ cd tests/Application && bin/console server:start --docroot=web
$ open http://127.0.0.1:8000
```

## Contributing
This library follows PHP coding standards, so pull requests need to execute the Fabien Potencier's [PHP-CS-Fixer][3].
Furthermore, if the PR creates some not-PHP file remember that you have to put the license header manually. In order
to simplify we provide a Composer script that wraps all the commands related with this process.
```bash
$ composer run-script cs
```

There is also a policy for contributing to this bundle. Pull requests must be explained step by step to make the
review process easy in order to accept and merge them. New methods or code improvements must come paired with
[PHPSpec][2] tests.

## Licensing Options
[![License](https://poser.pugx.org/lin3s/pattern-library-builder/license.svg)](https://github.com/LIN3S/PatternLibraryBuilder/blob/master/LICENSE)

[1]: http://getcomposer.org
[2]: http://www.phpspec.net/en/stable/
[3]: http://cs.sensiolabs.org/

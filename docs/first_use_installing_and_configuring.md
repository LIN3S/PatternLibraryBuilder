# Installing and configuring

The easiest way to install this bundle is using Composer
```bash
$ composer require lin3s/pattern-library-builder
```
Register the Bundle in your AppKernel 
```php
$bundles = [
    ...
    new Lin3sPatternLibraryBuilderBundle(),
    ...
];
```
Configure the basic settings in your `config.yml`:
```yaml
lin3s_pattern_library_builder:
    theme:
        title: "My title"
        description: "My description"
        custom_styles:
            color_primary: "#000"
        logo: ~
    templates_config_files_path: "%kernel.root_dir%/PatternLibrary"
```
Add routes to access the Design System in your routing file:
```yaml
_pattern_library:
    resource: "@Lin3sPatternLibraryBuilderBundle/Resources/config/routing.yml"
```
Create a folder in your AppBundle kernel root named `PatternLibrary` to store the Pattern Library configuration
and create an index configuration file.
```yaml
status: 0
description: '<p>This is the icon card component description.</p>'
renderer:
    type: homepage
    options:
        sections: []
```
Create a folder in your project's root named `templates` with the different subfolders of templates you want to have. 

Install assets 
```bash
$ bin/console assets:install --symlink
``` 

Now you can navigate to `http://localhost:8000/design-system` and see the index page.

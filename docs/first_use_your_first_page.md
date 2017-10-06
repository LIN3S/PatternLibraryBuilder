# Your first page

For rendering components in the Pattern Library first you should create a YAML in your `PatternLibrary` folder for the 
desired item to render. It is recommended to have separated folders inside PatternLibrary folder for separating 
different kind of  components.

For example:
```yaml
status: 2
description: '<p>This is the button atom description.</p>'
renderer:
    type: twig
    options:
        template: 'atoms/button.html.twig'
        preview_parameters:
            primary:
                content: Hola
            link:
                content: Hola 2
                modifier: orange
                href: test
                tag: a
```

Then, reference it in `index.yml` on the desired section with the corresponding slug based on directory structure:
```yaml
status: 0
description: '<p>This is the icon card component description.</p>'
renderer:
    type: homepage
    options:
        sections:
            -
                title: 'Atoms'
                description: 'These are the atoms'
                items:
                    -
                        slug: 'architecture/atoms/button'
```

The component to render must exists in the current views folder of your application.

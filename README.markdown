# T3DatatablesBundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/61803d08-17ab-4a69-ad13-6ec448762332/big.png)](https://insight.sensiolabs.com/projects/61803d08-17ab-4a69-ad13-6ec448762332)

[![knpbundles.com](http://knpbundles.com/stwe/DatatablesBundle/badge)](http://knpbundles.com/stwe/DatatablesBundle)

[![Latest Stable Version](https://poser.pugx.org/sg/datatablesbundle/v/stable.svg)](https://packagist.org/packages/sg/datatablesbundle) [![Total Downloads](https://poser.pugx.org/sg/datatablesbundle/downloads.svg)](https://packagist.org/packages/sg/datatablesbundle) [![Latest Unstable Version](https://poser.pugx.org/sg/datatablesbundle/v/unstable.svg)](https://packagist.org/packages/sg/datatablesbundle) [![License](https://poser.pugx.org/sg/datatablesbundle/license.svg)](https://packagist.org/packages/sg/datatablesbundle)

## Documentation

### master (unstable)

- [#85](https://github.com/stwe/DatatablesBundle/issues/85) Use datatable with Responsive extension
- [#56](https://github.com/stwe/DatatablesBundle/issues/56) Custom Column Types

You can now use your custom column type, simply by creating a new instance of the type:

``` php
$this->columnBuilder
    ->add("title", new CustomColumn(), array(
            "example_string_option" => "title",
            "example_boolean_option" => false
        ));
```

- New: Multiselect is a column type:

``` php
$this->getColumnBuilder()
    ->add(null, "multiselect", array(
        "start_html" => '<div class="wrapper" id="testwrapper">',
        "end_html" => '</div>',
        "attributes" => array(
            "class" => "testclass",
            "name" => "testname",
        ),
        "actions" => array(
            array(
                "route" => "post_bulk_delete",
                "label" => "Delete",
                "role" => "ROLE_ADMIN"
            ),
            array(
                "route" => "post_bulk_disable",
                "label" => "Disable"
            )
        )
    ));
```

[Read the Documentation for master](https://github.com/stwe/DatatablesBundle/blob/master/Resources/doc/index.md).

[The examples for master](https://github.com/stwe/DatatablesBundle/blob/master/Resources/doc/example.md)

### v0.6.1 (recommended)

- [#79](https://github.com/stwe/DatatablesBundle/issues/79) Decoupling JS from HTML - functions have been forgotten

[Read the Documentation for v0.6.1](https://github.com/stwe/DatatablesBundle/blob/v0.6.1/Resources/doc/index.md).

[The examples for v0.6.1](https://github.com/stwe/DatatablesBundle/blob/v0.6.1/Resources/doc/example.md)

## Installation

All the installation instructions are located in the documentation.

## Friendly License

This bundle is available under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

You are free to use, modify and distribute this software, as long as the copyright header is left intact (specifically the comment block which starts with /*)!

## Reporting an issue or a feature request

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/stwe/DatatablesBundle/issues).

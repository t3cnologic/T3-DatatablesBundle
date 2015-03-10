# Getting Started With T3DatatablesBundle

This Bundle integrates the jQuery DataTables 1.10.x plugin into your Symfony2 application.

## Installation

### Prerequisites

This bundle requires the following additional packages:

* Symfony 2.3.x
* jQuery 1.x
* DataTables 1.10.x
* Moment.js 2.8.x
* FOSJsRoutingBundle 1.5.3. ***Please follow all steps described [here](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle/blob/master/Resources/doc/index.md).***

The `require` part of your composer.json might look like this:

```js
    "require": {
        "symfony/symfony": "2.3.*",
        "components/jquery": "1.11.1",
        "datatables/datatables": "1.10.4",
        "moment/moment": "2.8.4",
        "friendsofsymfony/jsrouting-bundle": "@stable"
    },
```

### Translations

``` yaml
# app/config/config.yml

framework:
    translator: { fallback: %locale% }

    # ...

    default_locale:  "%locale%"
```

### Step 1: Download T3DatatablesBundle using composer

If not already done: add T3DatatablesBundle in your composer.json:

```js
{
    "require": {
        "t3/datatablesbundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update t3/datatablesbundle
```

Or get all bundles:

``` bash
$ php composer.phar update
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new T3\DatatablesBundle\T3DatatablesBundle(),
    );
}
```

### Step 3: Assetic Configuration

Include the jQuery, DataTables, Moment and FOSJsRoutingBundle javascript/css files in your layout.

## Full examples

- [Example](./example.md)

## List of available column types

- [Columns](./columns.md)

## To use a line formatter

- [Line formatter](./lineFormatter.md)

## Reference configuration

- [Reference configuration](./configuration.md)

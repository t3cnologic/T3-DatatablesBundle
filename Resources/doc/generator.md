# Use datatable class generator (since version 0.5)

## Default

By default the command is run in a non interactive mode.

``` bash
$ php app/console datatable:generate:class MyTestBundle:Entity
```

## Available Options

- `entity` (required): The entity name given as a shortcut notation containing the bundle name in which the entity is located and the name of the entity. For example: AcmeBlogBundle:Post

``` bash
$ php app/console datatable:generate:class AcmeBlogBundle:Post
```

- `--style` (optional, default: "bootstrap"): The datatable style (base, base-no-classes, base-row-borders, base-cell-borders, base-hover, base-order, base-stripe, jquery-ui, bootstrap, foundation).

``` bash
$ php app/console datatable:generate:class --entity=AcmeBlogBundle:Post --style=base
```

- `--fields` (optional): The list of fields to generate in the class.

``` bash
$ php app/console datatable:generate:class --entity=AcmeBlogBundle:Post --fields="id name createdAt:timeago"
```

- `--client-side` (optional): The client-side flag.

``` bash
$ php app/console datatable:generate:class --entity=AcmeBlogBundle:Post --client-side
```

- `--ajax-url` (optional): The ajax url.

``` bash
$ php app/console datatable:generate:class --entity=AcmeBlogBundle:Post --ajax-url=test_path
```

- `--filtering` (optional): The individual filtering flag.

``` bash
$ php app/console datatable:generate:class --entity=AcmeBlogBundle:Post --filtering
```

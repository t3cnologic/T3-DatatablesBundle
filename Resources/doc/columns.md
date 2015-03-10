# Columns

## Column

Represents the most basic column, including many-to-one and one-to-one relations.

### Default template

T3DatatablesBundle:Column:column.html.twig

### Options

| Option     | Type           | Default |
|------------|----------------|---------|
| class      | string         | ""      |
| padding    | string         | ""      |
| name       | string         | ""      |
| orderable  | boolean        | true    |
| render     | null or string | null    |
| searchable | boolean        | true    |
| title      | string         | ""      |
| type       | string         | ""      |
| visible    | boolean        | true    |
| width      | string         | ""      |
| default    | string         | ""      |

### Example

``` php
$this->columnBuilder
    ->add("title", "column", array(
            "title" => "title",
            "searchable" => false,
            "orderable" => false,
            "default" => "default title value"
        ));
```

For many-to-one associations:

``` php
$this->columnBuilder
    ->add("createdBy.username", "column", array(
            "title" => "CreatedBy"
        ))
    ->add("updatedBy.username", "column", array(
            "title" => "UpdatedBy"
        ));
```
___

## Array column

Represents a column for many-to-many or one-to-many associations.

### Default template

T3DatatablesBundle:Column:column.html.twig

### Options

| Option     | Type           | Default |          |
|------------|----------------|---------|----------|
| class      | string         | ""      |          |
| padding    | string         | ""      |          |
| name       | string         | ""      |          |
| orderable  | boolean        | true    |          |
| render     | null or string | null    |          |
| searchable | boolean        | true    |          |
| title      | string         | ""      |          |
| type       | string         | ""      |          |
| visible    | boolean        | true    |          |
| width      | string         | ""      |          |
| default    | string         | ""      |          |
| data       | string         |         | required |

### Example

``` php
$this->columnBuilder
    ->add("tags.name", "array", array(
            "title" => "Tags",
            "data" => "tags[, ].name" // required option
        ));
```
___

## Virtual column

Represents a virtual column.

### Default template

T3DatatablesBundle:Column:column.html.twig

### Options

| Option     | Type           | Default |
|------------|----------------|---------|
| class      | string         | ""      |
| padding    | string         | ""      |
| name       | string         | ""      |
| render     | null or string | null    |
| title      | string         | ""      |
| type       | string         | ""      |
| visible    | boolean        | true    |
| width      | string         | ""      |
| default    | string         | ""      |
| label      | string         | ""      |
| attributes | array          | array() |
| render_if  | array          | array() |

### Example

``` php
$this->columnBuilder
    ->add("a virtual field", "virtual");
```
___

## Boolean column

Represents a boolean column.

### Default template

T3DatatablesBundle:Column:boolean.html.twig

### Options

| Option      | Type           | Default          |
|-------------|----------------|------------------|
| class       | string         | ""               |
| padding     | string         | ""               |
| name        | string         | ""               |
| orderable   | boolean        | true             |
| render      | null or string | render_boolean   |
| searchable  | boolean        | true             |
| title       | string         | ""               |
| type        | string         | ""               |
| visible     | boolean        | true             |
| width       | string         | ""               |
| true_icon   | string         | ""               |
| false_icon  | string         | ""               |
| true_label  | string         | ""               |
| false_label | string         | ""               |

### Example

``` php
$this->columnBuilder
    ->add("visible", "boolean", array(
            "title" => "Visible",
            "true_icon" => "glyphicon glyphicon-ok",
            "false_icon" => "glyphicon glyphicon-remove",
            "true_label" => "yes",
            "false_label" => "no"
        ));
```
___

## DateTime column

Represents a datetime column.

### Default template

T3DatatablesBundle:Column:datetime.html.twig

### Options

| Option      | Type           | Default           |
|-------------|----------------|-------------------|
| class       | string         | ""                |
| padding     | string         | ""                |
| name        | string         | ""                |
| orderable   | boolean        | true              |
| render      | null or string | render_datetime   |
| searchable  | boolean        | true              |
| title       | string         | ""                |
| type        | string         | ""                |
| visible     | boolean        | true              |
| width       | string         | ""                |
| date_format | string         | "lll"             |

### Example

``` php
$this->columnBuilder
    ->add("createdAt", "datetime", array(
            "title" => "Created",
            "format" => "LLL" // default = "lll"
        ));
```
___

## Timeago column

Represents a timeago column.

### Default template

T3DatatablesBundle:Column:timeago.html.twig

### Options

| Option      | Type           | Default         |
|-------------|----------------|-----------------|
| class       | string         | ""              |
| padding     | string         | ""              |
| name        | string         | ""              |
| orderable   | boolean        | true            |
| render      | null or string | render_timeago  |
| searchable  | boolean        | true            |
| title       | string         | ""              |
| type        | string         | ""              |
| visible     | boolean        | true            |
| width       | string         | ""              |

### Example

``` php
$this->columnBuilder
    ->add("createdAt", "timeago", array(
            "title" => "Created"
        ));
```
___

## Action column

Represents an action column.

### Default template

T3DatatablesBundle:Column:action.html.twig

### Options

| Option     | Type        | Default |          |
|------------|-------------|---------|----------|
| class      | string      | ""      |          |
| padding    | string      | ""      |          |
| name       | string      | ""      |          |
| title      | string      | ""      |          |
| type       | string      | ""      |          |
| visible    | boolean     | true    |          |
| width      | string      | ""      |          |
| start_html | string      | ""      |          |
| end_html   | string      | ""      |          |
| actions    | array       |         | required |

### Action options

| Option           | Type        | Default |
|------------------|-------------|---------|
| route            | string      | ""      |
| route_parameters | array       | array() |
| icon             | string      | ""      |
| label            | string      | ""      |
| confirm          | boolean     | false   |
| confirm_message  | string      | ""      |
| attributes       | array       | array() |
| role             | string      | ""      |
| renderif         | array       | array() |

### Example

``` php
$this->columnBuilder
    ->add(null, "action", array(
        "title" => "Actions",
        "start_html" => '<div class="wrapper_example_class">',
        "end_html" => '</div>',
        "actions" => array( // required option
            array(
                "route" => "post_edit",
                "route_parameters" => array(
                    "id" => "id"
                ),
                "icon" => "glyphicon glyphicon-edit",
                "attributes" => array(
                    "rel" => "tooltip",
                    "title" => "Edit",
                    "class" => "btn btn-primary btn-xs",
                    "role" => "button"
                ),
                "confirm" => true,
                "confirm_message" => "Are you sure?",
                "role" => "ROLE_ADMIN",
                "renderif" => array(
                    "enabled"
                )
            ),
            array(
                "route" => "post_show",
                "route_parameters" => array(
                    "id" => "id"
                ),
                "label" => "Show",
                "attributes" => array(
                    "rel" => "tooltip",
                    "title" => "Show",
                    "class" => "btn btn-default btn-xs",
                    "role" => "button"
                ),
                "role" => "ROLE_USER",
                "renderif" => array(
                    "enabled"
                )
            )
        )
    ));
```
___

## Multiselect column

### Default template

T3DatatablesBundle:Column:multiselect.html.twig

### Options

| Option     | Type        | Default |
|------------|-------------|---------|
| class      | string      | ""      |
| padding    | string      | ""      |
| name       | string      | ""      |
| type       | string      | ""      |
| visible    | boolean     | true    |
| width      | string      | ""      |
| start_html | string      | ""      |
| end_html   | string      | ""      |
| actions    | array       | array() |
| attributes | array       | array() |

### Action options

| Option           | Type        | Default |
|------------------|-------------|---------|
| route            | string      | ""      |
| label            | string      | ""      |
| role             | string      | ""      |

### Example

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

# Reference Configuration

```yaml
t3_datatables:
    default_layout:
        page_length:          10
        server_side:          true
        processing:           true
        individual_filtering: false
        templates:
            base: 'T3DatatablesBundle:Datatable:datatable.html.twig'
            html: 'T3DatatablesBundle:Datatable:datatable_html.html.twig'
            js:   'T3DatatablesBundle:Datatable:datatable_js.html.twig'
```

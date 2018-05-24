# ldf-gutenberg v0.1.0

Gutenberg is a view renderer written in PHP and based on the fact that view **must** be totally separated from logic.

This system will allow you to easily substitute some variables for values and compose views in an easy way for a CMS, 
but you will not find control structures such as if/ese statements or even template inheritance. If you are looking 
for this kind of feature, I recommend to have a look at [Blade](https://laravel.com/docs/5.6/blade) 
or [Twig](https://twig.symfony.com/).

## How to install
 
To-Do :-)

## Template files

Template files are just .html files (as they are expected to contain just html with a couple of Guttemberg tweaks). 
They must be place in a workspace. 

A workspace is essentially a path to a directory. 

Templates are referenced by an id which, by convention, resolves to a file in the workspace.

For example, a template identified by ```myTemplate``` will resolve to path ```./workspace/myTemplate.html``` and 
another tempalte identified by ```partials/_widget``` will resolve to path ```./workspace/partials/_widget.html```

* By the way, it is recommended that, by convention you prefix your partial files with underscore ```_``` 
(you may recognize this convention).

If you decide to an extension other than ```.html``` for your templates, you can specify this as part of your 
identifier with something like ```myTemplate.tpl```. 

## Keywords

Gutemberg provides some expressions to allow you to define some dinamic points in your templates.

### Generally speaking

Expressions in Gutenberg are anything you place between double curly braces.

If you want to print double curly braces you must use the html entity instead: 

```html
The value of variable "myvar" is {{ myvar }}
&#123;&#123;This will be displayed in the html.&#124;;&#124;
```

### Variables

Variables will be refere
{{ }}

### import

`{{ import tplname}}`

You are already in a workspace, so you can not import templates from another workspace. This way you are forced to avoid cross dependencies.

### wrapper

`{{ wrapper tplname}}` 

We don't support inheritance -no, we don't like inheritance. Instead, you are able to wrap templates. Think of wrapping as a sort of reverse-import in which the wrapped template can define one -and only one- template to be wrapped. 
 
When you use wrapping, the source code file must start exactly by the wrapper command.

Wrappers use the ``{{ content }}`` mark to define the place were the inner template will be wrapped.
  
### comments

`{{-` (a.k.a X-Wing operator)

The rest of the line is a comment and will be ingored. For multiple-line comments you can send some X-Wing spaceships:

```html/gutenberg
{{-
{{- This is a multi-line comment.
{{- You can use it as header of template files.
{{- Everything you write in a comment will be ignored and will not appear in the ouput.
{{-
<strong>
    This will be rendered
</strong>

```

Now, be a good kid and go add some comments to your code.

### Control structures

So, how can I add some structures such as `if`/`else` or `foreach`? The answer is easy: __you can't__.

Logic should not be on your templates, so you must take care of passing exactly the substitution values ready to use. 
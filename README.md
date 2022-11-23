![Alt text](docs/logo.png?raw=true "logo")


# Contao Twig Assets
Adding assets via the global array `$GLOBALS` is no more possible when using TWIG templates.
This Bundle for the Contao CMS provides **5 TWIG functions** to load assets from inside your **TWIG template**.


## Usage

Each of these five functions take two parameters e.g. addJavascriptResource($resource_path, $position)
The first parameter '$resource_path' is mandatory, while the second parameter '$position' is optional.


**Default usage:**
```
{# Inside your twig template: #}

{% do addJavascriptResource('bundles/contaofoobarplugin/js/my.js|static') %}
{# Same as $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaofoobarplugin/js/my.js|static'; #}
```

**Set a javascript resource at a fixed position or replacing it:**
```
{# Inside your twig template: #}

{% do addJavascriptResource('bundles/contaofoobarplugin/js/my.js|static', 2) %}
{# Same as $GLOBALS['TL_JAVASCRIPT'][2] = 'bundles/contaofoobarplugin/js/my.js|static'; #}
```


## Overview
```
{# Inside your twig template: #}

{% do addJavascriptResource('bundles/contaofoobarplugin/js/my.js|static') %}
{# Same as $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaofoobarplugin/js/my.js|static'; #}


{% do addCssResource('bundles/contaofoobarplugin/css/style.css|static') %}
{# Same as $GLOBALS['TL_CSS'][] = 'bundles/contaofoobarplugin/css/style.css|static'; #}


{% do addHtmlToHead('<script src="bundles/contaofoobarplugin/script.js"></script>') %}
{# Same as $GLOBALS['TL_HEAD'][] = '<script src="bundles/contaofoobarplugin/script.js"></script>'; #}


{% do addHtmlToBody('<script src="bundles/contaofoobarplugin/scripts.js"></script>') %}
{# Same as $GLOBALS['TL_BODY'][] = '<script src="bundles/contaofoobarplugin/script.js"></script>'; #}


{% do addMootoolsResource('<script src="bundles/myextension/moo_scripts.js"></script>') %}
{# Same as $GLOBALS['TL_MOOTOOLS'][] = '<script src="bundles/contaofoobarplugin/moo_script.js"></script>'; #}
```

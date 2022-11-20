![Alt text](docs/logo.png?raw=true "logo")


# Welcome to Contao Twig Assets
Adding assets via the global array `$GLOBALS` is no more possible when using TWIG templates.
This Bundle for the Contao CMS provides 5 TWIG functions to load assets from inside your TWIG template.

```
{# Inside your TWIG template: #}


{# Sames as $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaofoobarplugin/js/my.js|static'; #}
{% do addJavascriptResource('bundles/contaofoobarplugin/js/my.js|static') %}


{# Sames as $GLOBALS['TL_CSS'][] = 'bundles/contaofoobarplugin/css/style.css|static'; #}
{% do addCssResource('bundles/contaofoobarplugin/css/style.css|static') %}


{# Sames as $GLOBALS['TL_HEAD'][] = '<script src="bundles/contaofoobarplugin/script.js"></script>'; #}
{% do addHtmlToHead('<script src="bundles/contaofoobarplugin/script.js"></script>') %}


{# Sames as $GLOBALS['TL_BODY'][] = '<script src="bundles/contaofoobarplugin/script.js"></script>'; #}
{% do addHtmlToBody('<script src="bundles/contaofoobarplugin/scripts.js"></script>') %}


{# Sames as $GLOBALS['TL_MOOTOOLS'][] = '<script src="bundles/contaofoobarplugin/moo_script.js"></script>'; #}
{% do addMootoolsResource('<script src="bundles/myextension/moo_scripts.js"></script>') %}
```

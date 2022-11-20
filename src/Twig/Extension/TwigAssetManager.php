<?php

declare(strict_types=1);

/*
 * This file is part of Contao Twig Assets.
 *
 * (c) Marko Cupic 2022 <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-twig-assets
 */

namespace Markocupic\ContaoTwigAssets\Twig\Extension;

use Markocupic\ContaoTwigAssets\Twig\DocumentLocation\DocumentLocation;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigAssetManager extends AbstractExtension
{
    public function __construct()
    {
        $this->createGlobalsIfNotSet();
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('addCssResource', [$this, 'addCssResource']),
            new TwigFunction('addJavascriptResource', [$this, 'addJavascriptResource']),
            new TwigFunction('addMootoolsResource', [$this, 'addMootoolsResource']),
            new TwigFunction('addHtmlToBody', [$this, 'addHtmlToBody']),
            new TwigFunction('addHtmlToHead', [$this, 'addHtmlToHead']),
        ];
    }

    /**
     * Append CSS Resource from inside your Twig template.
     *
     * Inside your Twig template:
     * {% do addCssResource('bundles/foobar/css/my.css|static %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addCssResource(string $res): void
    {
        $GLOBALS[DocumentLocation::TL_CSS->value][] = $res;
    }

    /**
     * Append Javascript Resource from inside your Twig template.
     *
     * Inside your Twig template:
     * {% do addJavascriptResource('bundles/foobar/js/my.js|static %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addJavascriptResource(string $res): void
    {
        $GLOBALS[DocumentLocation::TL_JAVASCRIPT->value][] = $res;
    }

    /**
     * Include HTML before </body>.
     *
     * Inside your Twig template:
     * {% do addMootoolsResource('<script src="bundles/myextension/scripts.js"></script> %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addMootoolsResource(string $res): void
    {
        $GLOBALS[DocumentLocation::TL_MOOTOOLS->value][] = $res;
    }

    /**
     * Include HTML before </body>.
     *
     * Inside your Twig template:
     * {% do addHtmlToBody('<script src="bundles/myextension/scripts.js"></script> %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addHtmlToBody(string $res): void
    {
        $GLOBALS[DocumentLocation::TL_BODY->value][] = $res;
    }

    /**
     * Include HTML in the <head> of your document.
     *
     * Inside your Twig template:
     * {% do addHtmlToHead('<script src="bundles/myextension/scripts.js"></script> %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addHtmlToHead(string $res): void
    {
        $GLOBALS[DocumentLocation::TL_HEAD->value][] = $res;
    }

    private function createGlobalsIfNotSet(): void
    {
        $keys = [
            DocumentLocation::TL_CSS->value,
            DocumentLocation::TL_JAVASCRIPT->value,
            DocumentLocation::TL_HEAD->value,
            DocumentLocation::TL_BODY->value,
            DocumentLocation::TL_MOOTOOLS->value,
        ];

        foreach ($keys as $key) {
            if (!isset($GLOBALS[$key])) {
                $GLOBALS[$key] = [];
            }
        }
    }
}

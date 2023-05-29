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
    public function __construct(
        private readonly string $projectDir,
    ) {
        $this->createGlobalsIfNotSet();
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getFileMakeTime', [$this, 'getFileMakeTime']),
            new TwigFunction('addCssResource', [$this, 'addCssResource']),
            new TwigFunction('addJavascriptResource', [$this, 'addJavascriptResource']),
            new TwigFunction('addMootoolsResource', [$this, 'addMootoolsResource']),
            new TwigFunction('addHtmlToBody', [$this, 'addHtmlToBody']),
            new TwigFunction('addHtmlToHead', [$this, 'addHtmlToHead']),
        ];
    }

    /**
     * Get the file make time (filemtime()) from inside your Twig template.
     *
     * Inside your Twig template:
     * {% set fileMakeTime = getFileMakeTime('vendor/foo-bar-bundle/public/css/my.css') %}.
     * {# append the version parameter to ensure that clients receive the latest version of the asset, when it changes. #}
     * {% do addCssResource('bundles/foobar/css/my.css|' ~ fileMakeTime) %}
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function getFileMakeTime(string $res): int
    {
        if (is_file($this->projectDir.'/'.$res)) {
            return filemtime($this->projectDir.'/'.$res);
        }

        if (is_file($res)) {
            return filemtime($res);
        }

        throw new \Exception(sprintf('File "%s" not found.', $res));
    }

    /**
     * Append CSS Resource from inside your Twig template.
     *
     * Inside your Twig template:
     * {% do addCssResource('bundles/foobar/css/my.css|static') %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addCssResource(string $res, int|string|null $pos = null): void
    {
        $this->addResource(DocumentLocation::TL_CSS->value, $res, $pos);
    }

    /**
     * Append Javascript Resource from inside your Twig template.
     *
     * Inside your Twig template:
     * {% do addJavascriptResource('bundles/foobar/js/my.js|static') %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addJavascriptResource(string $res, int|string|null $pos = null): void
    {
        $this->addResource(DocumentLocation::TL_JAVASCRIPT->value, $res, $pos);
    }

    /**
     * Include HTML before </body>.
     *
     * Inside your Twig template:
     * {% do addMootoolsResource('<script src="bundles/myextension/scripts.js"></script>') %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addMootoolsResource(string $res, int|string|null $pos = null): void
    {
        $this->addResource(DocumentLocation::TL_MOOTOOLS->value, $res, $pos);
    }

    /**
     * Include HTML before </body>.
     *
     * Inside your Twig template:
     * {% do addHtmlToBody('<script src="bundles/myextension/scripts.js"></script>') %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addHtmlToBody(string $res, int|string|null $pos = null): void
    {
        $this->addResource(DocumentLocation::TL_BODY->value, $res, $pos);
    }

    /**
     * Include HTML in the <head> of your document.
     *
     * Inside your Twig template:
     * {% do addHtmlToHead('<script src="bundles/myextension/scripts.js"></script>') %}.
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function addHtmlToHead(string $res, int|string|null $pos = null): void
    {
        $this->addResource(DocumentLocation::TL_HEAD->value, $res, $pos);
    }

    public function addResource(string $location, string $res, int|string|null $pos = null): void
    {
        if (!\in_array($location, $this->getGlobalsKeys(), true)) {
            throw new \Exception("'%s' is not a valid asset location.");
        }

        if ($pos) {
            $GLOBALS[$location][$pos] = $res;
        } else {
            $GLOBALS[$location][] = $res;
        }
    }

    private function createGlobalsIfNotSet(): void
    {
        foreach ($this->getGlobalsKeys() as $key) {
            if (!isset($GLOBALS[$key])) {
                $GLOBALS[$key] = [];
            }
        }
    }

    private function getGlobalsKeys(): array
    {
        return [
            DocumentLocation::TL_CSS->value,
            DocumentLocation::TL_JAVASCRIPT->value,
            DocumentLocation::TL_HEAD->value,
            DocumentLocation::TL_BODY->value,
            DocumentLocation::TL_MOOTOOLS->value,
        ];
    }
}

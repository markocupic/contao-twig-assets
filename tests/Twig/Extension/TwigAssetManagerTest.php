<?php

declare(strict_types=1);

/*
 * This file is part of Contao Twig Assets.
 *
 * (c) Marko Cupic <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-twig-assets
 */

namespace Markocupic\ContaoTwigAssets\Tests\Twig\Extension;

use Markocupic\ContaoTwigAssets\Twig\Extension\TwigAssetManager;
use PHPUnit\Framework\TestCase;

class TwigAssetManagerTest extends TestCase
{
    private const KEYS = ['TL_CSS', 'TL_JAVASCRIPT', 'TL_HEAD', 'TL_BODY', 'TL_MOOTOOLS'];

    private string $file;

    protected function setUp(): void
    {
        foreach (self::KEYS as $key) {
            unset($GLOBALS[$key]);
        }

        $this->file = sys_get_temp_dir().'/contao_twig_assets_test.css';
        file_put_contents($this->file, 'body {}');
    }

    protected function tearDown(): void
    {
        foreach (self::KEYS as $key) {
            unset($GLOBALS[$key]);
        }

        if (is_file($this->file)) {
            unlink($this->file);
        }
    }

    public function testAddsResourcesToTheGlobals(): void
    {
        $manager = new TwigAssetManager(sys_get_temp_dir());

        $manager->addCssResource('bundles/foo/css/style.css|static');
        $manager->addJavascriptResource('bundles/foo/js/script.js', 'foo');
        $manager->addHtmlToHead('<meta name="foo">');
        $manager->addHtmlToBody('<script></script>');
        $manager->addMootoolsResource('<script></script>');

        $this->assertSame(['bundles/foo/css/style.css|static'], $GLOBALS['TL_CSS']);
        $this->assertSame(['foo' => 'bundles/foo/js/script.js'], $GLOBALS['TL_JAVASCRIPT']);
        $this->assertSame(['<meta name="foo">'], $GLOBALS['TL_HEAD']);
        $this->assertSame(['<script></script>'], $GLOBALS['TL_BODY']);
        $this->assertSame(['<script></script>'], $GLOBALS['TL_MOOTOOLS']);
    }

    public function testAppendsTheFileMakeTime(): void
    {
        $manager = new TwigAssetManager(sys_get_temp_dir());
        $manager->addCssResource(basename($this->file), null, true);

        $this->assertSame(basename($this->file).'?_ver='.filemtime($this->file), $GLOBALS['TL_CSS'][0]);
    }

    public function testThrowsOnInvalidLocation(): void
    {
        $manager = new TwigAssetManager(sys_get_temp_dir());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('"TL_FOO" is not a valid asset location.');

        $manager->addResource('TL_FOO', 'foo.css');
    }
}

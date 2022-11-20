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

namespace Markocupic\ContaoTwigAssets;

use Markocupic\ContaoTwigAssets\DependencyInjection\MarkocupicContaoTwigAssetsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarkocupicContaoTwigAssets extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): MarkocupicContaoTwigAssetsExtension
    {
        return new MarkocupicContaoTwigAssetsExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}

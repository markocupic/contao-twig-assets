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

namespace Markocupic\ContaoTwigAssets\Twig\DocumentLocation;

enum DocumentLocation: string
{
    case TL_HEAD = 'TL_HEAD';
    case TL_BODY = 'TL_BODY';
    case TL_MOOTOOLS = 'TL_MOOTOOLS';
    case TL_CSS = 'TL_CSS';
    case TL_JAVASCRIPT = 'TL_JAVASCRIPT';
}

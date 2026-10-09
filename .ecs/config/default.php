<?php

declare(strict_types=1);

use Contao\EasyCodingStandard\Fixer\TypeHintOrderFixer;
use Contao\EasyCodingStandard\Set\SetList;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return ECSConfig::configure()
    ->withSets([SetList::CONTAO])
    ->withPaths([
        __DIR__.'/../../src',
    ])
    ->withSkip([
        \Contao\EasyCodingStandard\Fixer\CommentLengthFixer::class => ['*.php'],
        MethodChainingIndentationFixer::class => [
            '*/DependencyInjection/Configuration.php',
        ],
        TypeHintOrderFixer::class,
    ])
    ->withParallel()
    ->withSpacing(Option::INDENTATION_SPACES, "\n")
    ->withConfiguredRule(HeaderCommentFixer::class, [
        'header' => "This file is part of Contao Twig Assets.\n\n(c) Marko Cupic <m.cupic@gmx.ch>\n@license GPL-3.0-or-later\nFor the full copyright and license information,\nplease view the LICENSE file that was distributed with this source code.\n@link https://github.com/markocupic/contao-twig-assets",
    ])
    ->withCache(sys_get_temp_dir().'/ecs/markocupic/contao-twig-assets')
;

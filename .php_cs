<?php

/*
 * This file is part of StringBuilder.
 *
 * (c) Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<'EOS'
This file is part of StringBuilder.

(c) Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOS;

$classElementOrder = [
    'use_trait',
    'constant_public',
    'constant_protected',
    'constant_private',
    'property_public',
    'property_protected',
    'property_private',
    'construct',
    'destruct',
    'magic',
    'phpunit',
    'method_public_static',
    'method_protected_static',
    'method_private_static',
    'method_public',
    'method_protected',
    'method_private',
];

$rules = [
    '@PSR2' => true,
    '@Symfony' => true,

    'array_syntax' => [
        'syntax' => 'short',
    ],
    'combine_consecutive_issets' => true,
    'combine_consecutive_unsets' => true,
    'compact_nullable_typehint' => true,
    'explicit_indirect_variable' => true,
    'explicit_string_variable' => true,
    'header_comment' => [
        'header' => $header,
    ],
    'linebreak_after_opening_tag' => true,
    'list_syntax' => [
        'syntax' => 'long',
    ],
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'ordered_class_elements' => [
        'order' => $classElementOrder,
        'sortAlgorithm' => 'alpha',
    ],
    'ordered_imports' => true,
    'phpdoc_align' => [
        'align' => 'left',
    ],
    'phpdoc_no_package' => false,
    'return_type_declaration' => [
        'space_before' => 'one',
    ],
    'single_line_comment_style' => [
        'comment_types' => ['hash'],
    ],
];

$finder = Finder::create()
    ->ignoreDotFiles(false)
    ->name('.php_cs')
    ->exclude('vendor')
    ->in(__DIR__);

return Config::create()
    ->setRules($rules)
    ->setFinder($finder)
    ->setUsingCache(true);

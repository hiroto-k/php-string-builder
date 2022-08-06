<?php

/*
 * This file is part of StringBuilder.
 *
 * (c) hiroxto <hiroxto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<'EOS'
This file is part of StringBuilder.

(c) hiroxto <hiroxto@gmail.com>

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

    'align_multiline_comment' => [
        'comment_type' => 'phpdocs_like',
    ],
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'binary_operator_spaces' => true,
    'combine_consecutive_issets' => true,
    'combine_consecutive_unsets' => true,
    'compact_nullable_typehint' => true,
    'encoding' => true,
    'explicit_indirect_variable' => true,
    'explicit_string_variable' => true,
    'header_comment' => [
        'header' => $header,
    ],
    'linebreak_after_opening_tag' => true,
    'list_syntax' => [
        'syntax' => 'short',
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => false,
    ],
    'method_chaining_indentation' => true,
    'multiline_comment_opening_closing' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'no_alternative_syntax' => true,
    'no_null_property_initialization' => true,
    'no_useless_else' => true,
    'not_operator_with_successor_space' => true,
    'ordered_class_elements' => [
        'order' => $classElementOrder,
        'sort_algorithm' => 'alpha',
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

return (new Config())
    ->setRules($rules)
    ->setFinder($finder)
    ->setUsingCache(true);

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
    'psr0' => false,
    'binary_operator_spaces' => true,
    'encoding' => true,
    'phpdoc_no_package' => false,
    'header_comment' => compact('header'),
    'array_syntax' => ['syntax' => 'short'],
    'ordered_imports' => true,
    'linebreak_after_opening_tag' => true,
    'ordered_class_elements' => [
        'order' => $classElementOrder,
        'sortAlgorithm' => 'alpha',
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

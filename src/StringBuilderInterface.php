<?php

/*
 * This file is part of StringBuilder.
 *
 * (c) Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HirotoK\StringBuilder;

/**
 * Interface StringBuilderInterface.
 *
 * @author Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>
 *
 * @package HirotoK\StringBuilder
 */
interface StringBuilderInterface
{
    /**
     * Build the string.
     *
     * @return string
     */
    public function toString(): string;
}

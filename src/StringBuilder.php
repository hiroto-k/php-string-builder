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

use Stringable;

/**
 * Class StringBuilder.
 *
 * @author Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>
 *
 * @package HirotoK\StringBuilder
 */
class StringBuilder implements StringBuilderInterface, Stringable
{
    /**
     * Item.
     *
     * @var string
     */
    protected string $item;

    /**
     * StringBuilder constructor.
     *
     * @param Stringable|string $item String or object. For object, "__toString" method must be implemented
     */
    public function __construct(Stringable|string $item = '')
    {
        $this->item = (string) $item;
    }

    /**
     * Build the string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Make a StringBuilder instance.
     *
     * @param Stringable|string $item String or object. For object, "__toString" method must be implemented
     *
     * @return static
     */
    public static function make(Stringable|string $item = ''): static
    {
        return new static($item);
    }

    /**
     * Append to item.
     *
     * @param Stringable|string $value
     *
     * @return StringBuilder
     */
    public function append(Stringable|string $value): static
    {
        return new static($this->item.$value);
    }

    /**
     * Make a item lowercase.
     *
     * @return StringBuilder
     */
    public function downcase(): static
    {
        return new static(mb_strtolower($this->item));
    }

    /**
     * Determine if an item ends with a given substring.
     *
     * @param string[]|string $needles
     *
     * @return bool
     */
    public function endsWith(array|string $needles): bool
    {
        $needles = is_array($needles) ? $needles : [$needles];
        foreach ($needles as $needle) {
            $str = $this->subStr(-mb_strlen($needle))->toString();
            if ($needle === $str) {
                return true;
            }
        }

        return false;
    }

    /**
     * Split the item by $delimiter.
     *
     * @param Stringable|string $delimiter
     * @param int $limit
     *
     * @return array
     */
    public function explode(Stringable|string $delimiter, int $limit = PHP_INT_MAX): array
    {
        return explode($delimiter, $this->item, $limit);
    }

    /**
     * Find the position of the first occurrence of a substring in item.
     *
     * @param string|mixed $needle
     * @param int $offset
     *
     * @return int|null
     */
    public function indexOf(Stringable|string $needle, int $offset = 0): ?int
    {
        $location = strpos($this->item, $needle, $offset);

        return false === $location ? null : $location;
    }

    /**
     * Case-insensitive version of StringBuilder::replace().
     *
     * @param Stringable|string $search
     * @param Stringable|string $replace
     * @param null $count
     *
     * @return StringBuilder
     */
    public function ireplace(Stringable|string $search, Stringable|string $replace, &$count = null): static
    {
        return new static(str_ireplace($search, $replace, $this->item, $count));
    }

    /**
     * Make item's first character lowercase.
     *
     * @return StringBuilder
     */
    public function lcFirst(): static
    {
        return new static(lcfirst($this->item));
    }

    /**
     * Left pad an item to a certain length with another string.
     *
     * @param int $length
     * @param Stringable|string $string $string
     *
     * @return StringBuilder
     * @see \HirotoK\StringBuilder\StringBuilder::pad()
     */
    public function leftPad(int $length, Stringable|string $string = ''): static
    {
        return $this->pad($length, $string, STR_PAD_LEFT);
    }

    /**
     * Count item's length.
     *
     * @return int
     */
    public function length(): int
    {
        return mb_strlen($this->item);
    }

    /**
     * Limit the number of characters in item.
     *
     * @param int $limit
     * @param Stringable|string $end
     *
     * @return StringBuilder
     */
    public function limit(int $limit = 100, Stringable|string $end = '...'): static
    {
        if (mb_strwidth($this->item) <= $limit) {
            return $this;
        }
        $newItem = mb_strimwidth($this->item, 0, $limit, '').$end;
        $instance = new static($newItem);

        return $instance->rtrim();
    }

    /**
     * Strip whitespace from the beginning of item.
     *
     * @param Stringable|string $character_mask
     *
     * @return StringBuilder
     */
    public function ltrim(Stringable|string $character_mask = " \t\n\r\0\x0B"): static
    {
        return new static(ltrim($this->item, $character_mask));
    }

    /**
     * Pad a item to a certain length with another string.
     *
     * @param int $length
     * @param Stringable|string $string $string
     * @param int $type Default value is 'STR_PAD_RIGHT'
     *
     * @return StringBuilder
     * @see \HirotoK\StringBuilder\StringBuilder::leftPad()
     * @see \HirotoK\StringBuilder\StringBuilder::rightPad()
     */
    public function pad(int $length, Stringable|string $string = '', int $type = STR_PAD_RIGHT): static
    {
        return new static(str_pad($this->item, $length, $string, $type));
    }

    /**
     * Prepend to item.
     *
     * @param Stringable|string $value
     *
     * @return StringBuilder
     */
    public function prepend(Stringable|string $value): static
    {
        return new static($value.$this->item);
    }

    /**
     * Replace all occurrences of the item with the replacement string.
     *
     * @param Stringable|string $search
     * @param Stringable|string $replace
     * @param null $count
     *
     * @return StringBuilder
     */
    public function replace(Stringable|string $search, Stringable|string $replace, &$count = null): static
    {
        return new static(str_replace($search, $replace, $this->item, $count));
    }

    /**
     * Reverse item.
     *
     * @return StringBuilder
     */
    public function reverse(): static
    {
        return new static(strrev($this->item));
    }

    /**
     * Right pad an item to a certain length with another string.
     *
     * @param int $length
     * @param Stringable|string $string $string
     *
     * @return StringBuilder
     * @see \HirotoK\StringBuilder\StringBuilder::pad()
     */
    public function rightPad(int $length, Stringable|string $string = '')
    {
        return $this->pad($length, $string, STR_PAD_RIGHT);
    }

    /**
     * Strip whitespace from the end of item.
     *
     * @param Stringable|string $character_mask
     *
     * @return StringBuilder
     */
    public function rtrim(Stringable|string $character_mask = " \t\n\r\0\x0B"): static
    {
        return new static(rtrim($this->item, $character_mask));
    }

    /**
     * Randomly shuffles item.
     *
     * @return StringBuilder
     */
    public function shuffle(): static
    {
        return new static(str_shuffle($this->item));
    }

    /**
     * Alias method of 'length'.
     *
     * @return int
     */
    public function size(): int
    {
        return call_user_func_array([$this, 'length'], func_get_args());
    }

    /**
     * Convert item to an array.
     *
     * @param int $length
     *
     * @return array
     */
    public function split(int $length = 1): array
    {
        return str_split($this->item, $length);
    }

    /**
     * Determine if an item starts with a given substring.
     *
     * @param string|array $needles
     *
     * @return bool
     */
    public function startsWith(array|string $needles): bool
    {
        $needles = is_array($needles) ? $needles : [$needles];
        foreach ($needles as $needle) {
            if ('' !== $needle && 0 === mb_strpos($this->item, $needle)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Strip HTML and PHP tags from item.
     *
     * @param Stringable|string $allowableTags
     *
     * @return StringBuilder
     */
    public function stripTags(Stringable|string $allowableTags = ''): static
    {
        return new static(strip_tags($this->item, $allowableTags));
    }

    /**
     * Return part of item.
     *
     * @param int $start
     * @param int|null $length
     *
     * @return StringBuilder
     */
    public function subStr(int $start, int $length = null): static
    {
        return new static(mb_substr($this->item, $start, $length));
    }

    /**
     * Get the float value of item.
     *
     * @return float
     */
    public function toFloat(): float
    {
        return floatval($this->item);
    }

    /**
     * Get the integer value of item.
     *
     * @return int
     */
    public function toInt(): int
    {
        return intval($this->item);
    }

    /**
     * Build the string.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->item;
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of item.
     *
     * @param Stringable|string $character_mask
     *
     * @return StringBuilder
     */
    public function trim(Stringable|string $character_mask = " \t\n\r\0\x0B"): static
    {
        return new static(trim($this->item, $character_mask));
    }

    /**
     * Make a item's first character uppercase.
     *
     * @return StringBuilder
     */
    public function ucFirst(): static
    {
        return new static(ucfirst($this->item));
    }

    /**
     * Make a item upcase.
     *
     * @return StringBuilder
     */
    public function upcase(): static
    {
        return new static(mb_strtoupper($this->item));
    }
}

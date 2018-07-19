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
 * Class StringBuilder.
 *
 * @author Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>
 *
 * @package HirotoK\StringBuilder
 */
class StringBuilder implements StringBuilderInterface
{
    /**
     * Item.
     *
     * @var string
     */
    protected $item;

    /**
     * StringBuilder constructor.
     *
     * @param string|object $item String or object. For object, "__toString" method must be implemented
     */
    public function __construct($item = '')
    {
        $this->item = (string) $item;
    }

    /**
     * Build the string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Make a StringBuilder instance.
     *
     * @param string|object $item String or object. For object, "__toString" method must be implemented
     *
     * @return static
     */
    public static function make($item = '')
    {
        return new static($item);
    }

    /**
     * Append to item.
     *
     * @param string $value
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function append($value)
    {
        return new static($this->item.$value);
    }

    /**
     * Make a item lowercase.
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function downcase()
    {
        return new static(mb_strtolower($this->item));
    }

    /**
     * Determine if an item ends with a given substring.
     *
     * @param string|array $needles
     *
     * @return bool
     */
    public function endsWith($needles)
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
     * @param string $delimiter
     * @param int $limit
     *
     * @return array
     */
    public function explode($delimiter, $limit = PHP_INT_MAX)
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
    public function indexOf($needle, $offset = 0)
    {
        $location = strpos($this->item, $needle, $offset);

        return false === $location ? null : $location;
    }

    /**
     * Case-insensitive version of StringBuilder::replace().
     *
     * @param string $search
     * @param string $replace
     * @param null $count
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function ireplace($search, $replace, &$count = null)
    {
        return new static(str_ireplace($search, $replace, $this->item, $count));
    }

    /**
     * Make item's first character lowercase.
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function lcFirst()
    {
        return new static(lcfirst($this->item));
    }

    /**
     * Left pad an item to a certain length with another string.
     *
     * @see \HirotoK\StringBuilder\StringBuilder::pad()
     *
     * @param int $length
     * @param string $string
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function leftPad($length, $string = '')
    {
        return $this->pad($length, $string, STR_PAD_LEFT);
    }

    /**
     * Count item's length.
     *
     * @return int
     */
    public function length()
    {
        return mb_strlen($this->item);
    }

    /**
     * Limit the number of characters in item.
     *
     * @param int $limit
     * @param string $end
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function limit($limit = 100, $end = '...')
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
     * @param string $character_mask
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function ltrim(string $character_mask = " \t\n\r\0\x0B")
    {
        return new static(ltrim($this->item, $character_mask));
    }

    /**
     * Pad a item to a certain length with another string.
     *
     * @see \HirotoK\StringBuilder\StringBuilder::leftPad()
     * @see \HirotoK\StringBuilder\StringBuilder::rightPad()
     *
     * @param int $length
     * @param string $string
     * @param int $type Default value is 'STR_PAD_RIGHT'
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function pad($length, $string = '', $type = STR_PAD_RIGHT)
    {
        return new static(str_pad($this->item, $length, $string, $type));
    }

    /**
     * Prepend to item.
     *
     * @param string $value
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function prepend($value)
    {
        return new static($value.$this->item);
    }

    /**
     * Replace all occurrences of the item with the replacement string.
     *
     * @param string $search
     * @param string $replace
     * @param null $count
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function replace($search, $replace, &$count = null)
    {
        return new static(str_replace($search, $replace, $this->item, $count));
    }

    /**
     * Reverse item.
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function reverse()
    {
        return new static(strrev($this->item));
    }

    /**
     * Right pad an item to a certain length with another string.
     *
     * @see \HirotoK\StringBuilder\StringBuilder::pad()
     *
     * @param int $length
     * @param string $string
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function rightPad($length, $string = '')
    {
        return $this->pad($length, $string, STR_PAD_RIGHT);
    }

    /**
     * Strip whitespace from the end of item.
     *
     * @param string $character_mask
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function rtrim(string $character_mask = " \t\n\r\0\x0B")
    {
        return new static(rtrim($this->item, $character_mask));
    }

    /**
     * Randomly shuffles item.
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function shuffle()
    {
        return new static(str_shuffle($this->item));
    }

    /**
     * Alias method of 'length'.
     *
     * @return int
     */
    public function size()
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
    public function split($length = 1)
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
    public function startsWith($needles)
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
     * @param string $allowableTags
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function stripTags($allowableTags = '')
    {
        return new static(strip_tags($this->item, $allowableTags));
    }

    /**
     * Return part of item.
     *
     * @param int $start
     * @param int|null $length
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function subStr($start, $length = null)
    {
        return new static(mb_substr($this->item, $start, $length));
    }

    /**
     * Get the float value of item.
     *
     * @return float
     */
    public function toFloat()
    {
        return floatval($this->item);
    }

    /**
     * Get the integer value of item.
     *
     * @return int
     */
    public function toInt()
    {
        return intval($this->item);
    }

    /**
     * Build the string.
     *
     * @return string
     */
    public function toString()
    {
        return $this->item;
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of item.
     *
     * @param string $character_mask
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function trim(string $character_mask = " \t\n\r\0\x0B")
    {
        return new static(trim($this->item, $character_mask));
    }

    /**
     * Make a item's first character uppercase.
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function ucFirst()
    {
        return new static(ucfirst($this->item));
    }

    /**
     * Make a item upcase.
     *
     * @return \HirotoK\StringBuilder\StringBuilder
     */
    public function upcase()
    {
        return new static(mb_strtoupper($this->item));
    }
}

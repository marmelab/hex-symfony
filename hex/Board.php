<?php

namespace Hex;

/**
 * Class Board
 * @package Hex\Models
 */
class Board
{
    public const MINI_SIZE = 5;
    public const DEFAULT_SIZE = 11;
    public const LARGE_SIZE = 15;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var array
     */
    protected $stones = [];

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function hasStone(int $x, int $y): bool
    {
        return !empty(array_filter($this->stones, function (Stone $stone) use ($x, $y){
            return $stone->getX() == $x && $stone->getY() == $y;
        }));
    }

}

<?php

namespace Hex;

/**
 * Class Board
 * @package Hex\Models
 */
class Board
{

    /**
     * @var int
     */
    protected $size;

    /**
     * @var array
     */
    protected $stones = [];

    /**
     * Board constructor.
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return array
     */
    public function getStones(): array
    {
        return $this->stones;
    }

    /**
     * @param array $stones
     */
    public function setStones(array $stones): void
    {
        $this->stones = $stones;
    }

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

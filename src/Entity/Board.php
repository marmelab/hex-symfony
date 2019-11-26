<?php

namespace App\Entity;


/**
 * Class Board
 * @package App\Entity
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
    protected $stones_1 = [];

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
    public function getStones1(): array
    {
        return $this->stones_1;
    }

    /**
     * @param array $stones_1
     */
    public function setStones1(array $stones_1): void
    {
        $this->stones_1 = $stones_1;
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function hasStone1(int $x, int $y): bool
    {
        return !empty(array_filter($this->stones_1, function (Stone $stone) use ($x, $y){
            return $stone->x == $x && $stone->y == $y;
        }));
    }

}

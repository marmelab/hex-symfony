<?php

namespace Hex;


/**
 * Class Game
 * @package Hex
 */
class Game
{

    public const BOARD_MINI_SIZE = 5;
    public const BOARD_DEFAULT_SIZE = 11;
    public const BOARD_LARGE_SIZE = 15;

    protected $id;

    protected $stones;

    protected $size;

    /**
     * Game constructor.
     * @param $size
     */
    public function __construct($size)
    {
        $this->size = $size;
        $this->stones = [];
    }

    /**
     * @param $x
     * @param $y
     * @return bool
     */
    public function hasStone($x, $y)
    {
        return !empty(array_filter($this->stones, function ($stone) use ($x, $y) {
            return $x === $stone[0] && $y === $stone[1];
        }));
    }

    /**
     * @param $x
     * @param $y
     */
    public function addStone(int $x,int $y)
    {
        $limit_min = 0;
        $limit_max = $this->getSize() - 1;

        $x_is_inside = $x >= $limit_min || $x <= $limit_max;
        $y_is_inside = $y >= $limit_min || $y <= $limit_max;
        $already_played_move = in_array([$x,$y], $this->stones);

        if ($x_is_inside && $y_is_inside && !$already_played_move) {
            $this->stones[] = [$x,$y];
        }
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
     * @return Game
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Game
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBoard()
    {
        return $this->stones;
    }

    /**
     * @param mixed $board
     * @return Game
     */
    public function setBoard($board)
    {
        $this->stones = $board;
        return $this;
    }


}

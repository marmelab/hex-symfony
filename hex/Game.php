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

    protected $allowed_players;

    /**
     * Game constructor.
     * @param $size
     * @param $allowed_players
     */
    public function __construct($size, $allowed_players)
    {
        $this->size = $size;
        $this->stones = [];
        $this->allowed_players = $allowed_players;
    }

    /**
     * @param $x
     * @param $y
     * @return bool
     */
    public function hasStone($x, $y)
    {
        return !empty(array_filter($this->stones, function ($stone) use ($x, $y) {
            return $x === $stone['x'] && $y === $stone['y'];
        }));
    }

    /**
     * @param $x
     * @param $y
     */
    public function addStone(int $x, int $y, $player)
    {
        $limitMin = 0;
        $limitMax = $this->getSize() - 1;

        $xIsInside = $x >= $limitMin && $x <= $limitMax;
        $yIsInside = $y >= $limitMin && $y <= $limitMax;
        $alreadyPlayedMove = in_array([$x, $y], $this->stones);
        $isAllowedPlayer = in_array($player, $this->allowed_players);

        if ($xIsInside && $yIsInside && !$alreadyPlayedMove && $isAllowedPlayer) {
            $this->stones[] = ['x' => $x, 'y' => $y, 'player' => $player];
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
    public function getStones()
    {
        return $this->stones;
    }

    /**
     * @param mixed $stones
     * @return Game
     */
    public function setStones($stones)
    {
        $this->stones = $stones;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowedPlayers()
    {
        return $this->allowed_players;
    }

    /**
     * @param mixed $allowed_players
     * @return Game
     */
    public function setAllowedPlayers($allowed_players): Game
    {
        $this->allowed_players = $allowed_players;

        return $this;
    }


}

<?php

namespace App\Services;

use App\Entity\Board;
use App\Entity\Stone;

/**
 * Class GameManager
 * @package App\Services
 */
class GameManager
{

    /**
     * @var Board
     */
    protected $board;

    /**
     * @return $this
     */
    public function init()
    {
        $this->board = new Board(5);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBoard()
    {
        return $this->board;
    }

    /***
     * @param $input
     * @return GameManager
     */
    public function addStone($input): GameManager
    {
        $stones = [];
        foreach ($input as $coords){
            list($x, $y) = explode(',', $coords);
            $stones[] = new Stone($x, $y);
        }

        $this->getBoard()->setStones1($stones);

        return $this;
    }
}

<?php

namespace App\Services;

use App\Entity\Board;
use Hex\Stone;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameManager
 * @package App\Services
 */
class GameManager
{
    /***
     * @param Request $input
     * @param Board $board
     * @return GameManager
     */
    public function loadStoneFromRequest(Request $input, Board $board): GameManager
    {
        $stones = [];
        foreach ($input as $coords) {
            list($x, $y) = explode(',', $coords);
            $stones[] = new Stone($x, $y, 0);
        }

        return $board;
    }
}

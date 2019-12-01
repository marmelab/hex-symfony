<?php

namespace Hex;

use Ds\Set;

/**
 * Class Graph
 * @package Hex
 */
class Graph
{
    public const DIRECTIONS = [[-1, -1], [-1, 1], [0, -1], [0, 1], [1, 1], [1, 0]];
    public const STRING_FORMAT = '%s,%s';

    /**
     * @var Set
     */
    protected $connections;

    /**
     * Graph constructor.
     */
    public function __construct()
    {
        $this->connections = new Set();
    }

    /**
     * @param $x
     * @param $y
     * @param Game $game
     * @return array
     */
    public function loadNeighbors($x, $y, Game $game)
    {
        $neighbors = [];
        foreach (static::DIRECTIONS as $direction) {
            $xNeighbor = $x + $direction[0];
            $yNeighbor = $y + $direction[1];

            if ($game->isStoneOwnedByCurrentPlayer($xNeighbor, $yNeighbor)) {
                $neighbors[] = sprintf(static::STRING_FORMAT, $xNeighbor, $yNeighbor);
            }
        }
        return $neighbors;
    }

    /**
     * This function returns a boolean who determine is the start and the end point can be reach
     * Source : https://eddmann.com/posts/depth-first-search-and-breadth-first-search-in-python/
     *
     * Considers :
     * start --> 0,0 --> 1,0 --> 2,1 --> etc... --> end
     *
     * @param Game $game
     * @return bool
     */
    public function hasChain(Game $game)
    {
        $start = $this->getStartNeighbors($game);
        $end = $this->getEndNeighbors($game);

        $queue = [$start];
        $result = new Set();

        while ($queue) {

            $node = array_pop($queue);
            $key = key($node);

            $result->add($key);

            foreach (array_values($node[$key]) as $neighbor) {

                list($x, $y) = array_map('intval', explode(',', $neighbor, 2));

                if ($game->isStoneOwnedByCurrentPlayer($x, $y)) {

                    $neighbors = $this->loadNeighbors($x, $y, $game);

                    if (key($end) === $neighbor) {
                        return $game->getCurrentPlayer();
                    }

                    if ($neighbors) {
                        $queue[] = [$neighbor => $neighbors];
                    }
                }
            }
        }
    }

    /**
     * This function init neighbors for the starting point.
     *
     * @param Game $game
     * @return array
     */
    public function getStartNeighbors(Game $game)
    {
        $neighbors = [];
        foreach (range(0, $game->getSize() - 1) as $y) {
            if ($game->hasStone(0, $y)) {
                $neighbors[] = (sprintf('0,%s', $y));
            }
        }

        return ['start' => $neighbors];
    }

    /**
     * This function init neighbors for the ending point.
     *
     * @param Game $game
     * @return array
     */
    public function getEndNeighbors(Game $game): array
    {
        $neighbors = [];
        $limit = $game->getSize() - 1;

        foreach (range(0, $limit) as $y) {
            if ($game->hasStone($limit, $y)) {
                $neighbors[sprintf('%s,%s', $limit, $y)] = 'end';
            }
        }

        return $neighbors;
    }


}

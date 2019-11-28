<?php

namespace Hex;

use Ds\Set;

/**
 * Class Graph
 * @package Hex
 */
class Graph
{

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
     * This function returns a boolean who determine is the start and the end point can be reach
     * Source : https://eddmann.com/posts/depth-first-search-and-breadth-first-search-in-python/
     */
    public function hasChain()
    {
        $queue = [$this->connections->get(0)];

        while ($queue) {
            /** @var Connection */
            $path = array_pop($queue);

            $connections = $this->connections;

            foreach ($connections->diff($path) as $next) {
                if ($next == 'end') {
                    return true;
                } else {
                    $set = new Set();
                    $queue[] = $set->add($next, $path + [$next]);
                }
            }
        }
    }

    /**
     * @param Game $game
     */
    public function loadFromGame(Game $game)
    {
        $size = $game->getSize();

        $this->buildStartConnection($size);

        $stones = $game->getStones();
        foreach ($stones as $stone) {
            $this->buildConnection($game, $stone);
        }

        $this->buildEndConnection($size);
    }

    /**
     * This function init neighbors for the starting point.
     *
     * @param int $size
     * @return Set
     */
    public function getStartNeighbors(int $size)
    {
        $set = new Set();

        foreach (range(0, $size - 1) as $i) {
            $set->add(sprintf('0,%s', $i));
        }

        return $set;
    }

    /**
     * This function init neighbors for the ending point.
     *
     * @param int $size
     * @return Set
     */
    public function getEndNeighbors(int $size)
    {
        $set = new Set();

        foreach (range(0, $size - 1) as $i) {
            $set->add(sprintf('%s,%s', $i, $size));
        }

        return $set;
    }

    /**
     * @param Game $game
     * @param $stone
     */
    public function buildConnection(Game $game, $stone): void
    {
        $connection = (new Connection())->loadWithCoords($stone['x'], $stone['y'], $game);
        if (null === $connection->getNeighbors()) {
            $this->connections->add($connection);
        }
    }

    /**
     * @param $size
     */
    public function buildStartConnection($size): void
    {
        $neighbors = $this->getStartNeighbors($size);
        $this->buildDefinedConnection('start', $neighbors);
    }

    /**
     * @param $size
     */
    public function buildEndConnection($size): void
    {
        $neighbors = $this->getEndNeighbors($size);
        $this->buildDefinedConnection('end', $neighbors);
    }

    /**
     * @param string $point
     * @param Set $neighbors
     */
    public function buildDefinedConnection(string $point, Set $neighbors): void
    {
        $connection = new Connection();
        $connection->loadWithData($point, $neighbors);
        $this->connections->add($connection);
    }


}

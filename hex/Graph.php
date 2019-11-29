<?php

namespace Hex;

use Ds\Set;

/**
 * Class Graph
 * @package Hex
 */
class Graph
{
    public const DIRECTIONS = [[-1, -1], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0]];
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
            $xNeighbor = $x - $direction[0];
            $yNeighbor = $y - $direction[1];

            if ($game->hasStone($xNeighbor, $yNeighbor)) {
                $neighbors[] = sprintf(static::STRING_FORMAT, $xNeighbor, $yNeighbor);
            }
        }
        return $neighbors;
    }

    /**
     * This function returns a boolean who determine is the start and the end point can be reach
     * Source : https://eddmann.com/posts/depth-first-search-and-breadth-first-search-in-python/
     *
     * @param Game $game
     * @return bool
     */
    public function hasChain(Game $game)
    {
        $start = $this->getStartNeighbors($game->getSize() - 1);

        $queue = [$start];
        $result = new Set();

        while ($queue) {

            $connection = array_pop($queue);

            $key = array_key_first($connection);

            foreach ($connection[$key] as $neigbor) {
                list($x, $y) = explode(',', $neigbor, 2);
                $neigbors = $this->loadNeighbors((int)$x, (int)$y, $game);

                if($neigbors){
                    $queue[] = $connection;
                }
            }

        }

        return $result->contains('end');
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
        $neighbors = [];
        foreach (range(0, $size - 1) as $i) {
            $neighbors[] = (sprintf('0,%s', $i));
        }

        return ['start' => $neighbors];
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
        if (null !== $connection->getNeighbors()) {
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

    /**
     * @return Set
     */
    public function getConnections(): Set
    {
        return $this->connections;
    }

    /**
     * @param Set $connections
     */
    public function setConnections(Set $connections): void
    {
        $this->connections = $connections;
    }


}

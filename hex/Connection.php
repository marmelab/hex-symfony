<?php

namespace Hex;

use Ds\Set;

/**
 * Class Connection
 * @package Hex
 */
class Connection
{
    /**
     * Contains all possible directions in Hex neighborhood.
     */
    public const DIRECTIONS = [[-1, -1], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0]];

    /**
     * Default string formatting.
     */
    public const STRING_FORMAT = '%s,%s';

    /**
     * @var
     */
    protected $point;

    /**
     * @var Set
     */
    protected $neighbors;

    /**
     * @return string
     */
    public function toString()
    {
        return sprintf('%s->{%s}', $this->point, implode(',', $this->neighbors));
    }

    /**
     * @param int $x
     * @param int $y
     * @param Game $game
     * @return Connection
     */
    public function loadWithCoords(int $x, int $y, Game $game)
    {
        $this->point = sprintf(static::STRING_FORMAT, $x, $y);
        $this->loadNeighbors($x, $y, $game);

        return $this;
    }

    /**
     * Connection constructor.
     * @param string $point
     * @param Set $neighbors
     */
    public function loadWithData(string $point, Set $neighbors)
    {
        $this->point = $point;
        $this->setNeighbors($neighbors);

        return $this;
    }

    /**
     * @param $x
     * @param $y
     * @param $game
     */
    public function loadNeighbors($x, $y, Game $game)
    {
        foreach (static::DIRECTIONS as $direction) {
            $xNeighbor = $x - $direction[0];
            $yNeighbor = $y - $direction[1];

            if ($game->hasStone($xNeighbor, $yNeighbor)) {

                if (null === $this->neighbors) {
                    $this->neighbors = new Set();
                }

                $this->neighbors->add(sprintf(static::STRING_FORMAT, $xNeighbor, $yNeighbor));
            }
        }
    }

    /**
     * @return Set
     */
    public function getNeighbors(): ?Set
    {
        return $this->neighbors;
    }

    /**
     * @param Set $neighbors
     * @return Connection
     */
    public function setNeighbors(Set $neighbors): Connection
    {
        $this->neighbors = $neighbors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     * @return Connection
     */
    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }


}

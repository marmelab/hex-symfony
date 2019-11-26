<?php

namespace Hex;


/**
 * Class Stone
 * @package App
 */
class Stone
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $playerId;

    /**
     * @var int
     */
    protected $y;

    /**
     * Stone constructor.
     * @param $x
     * @param $y
     * @param $playerId
     */
    public function __construct($x, $y, $playerId)
    {
        $this->x = $x;
        $this->y = $y;
        $this->playerId = $playerId;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return Stone
     */
    public function setX(int $x): Stone
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlayerId(): int
    {
        return $this->playerId;
    }

    /**
     * @param int $playerId
     * @return Stone
     */
    public function setPlayerId(int $playerId): Stone
    {
        $this->playerId = $playerId;
        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     * @return Stone
     */
    public function setY(int $y): Stone
    {
        $this->y = $y;
        return $this;
    }


}

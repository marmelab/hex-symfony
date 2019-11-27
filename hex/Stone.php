<?php

namespace Hex;

/**
 * Class Game
 * @package App
 */
class Stone
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var Player
     */
    protected $player;

    /**
     * @var int
     */
    protected $y;

    /**
     * Game constructor.
     * @param int $x
     * @param Player $player
     * @param int $y
     */
    public function __construct(int $x, int $y, Player $player)
    {
        $this->x = $x;
        $this->player = $player;
        $this->y = $y;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

        return $this;
    }


}

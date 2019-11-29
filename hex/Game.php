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

    public const PLAYER_1 = 'player_1';
    public const PLAYER_2 = 'player_2';

    public const AUTHORIZED_NUMBER_OF_PLAYERS = 2;

    protected $id;

    protected $stones = [];

    protected $size;

    protected $players;

    protected $currentPlayer;

    /**
     * @return string
     */
    public function getCurrentPlayer(): string
    {
        return $this->currentPlayer;
    }

    /**
     * @param string $currentPlayer
     * @return Game
     */
    public function setCurrentPlayer(string $currentPlayer): Game
    {
        $this->currentPlayer = $currentPlayer;
        return $this;
    }

    /**
     * Game constructor.
     * @param $size
     */
    public function __construct($size)
    {
        $this->size = $size;
        $this->players = [];
        $this->stones = [];
        $this->currentPlayer = static::PLAYER_1;
    }

    /**
     * @return bool
     */
    public function hasEnoughPlayer(): bool
    {
        return static::AUTHORIZED_NUMBER_OF_PLAYERS === count($this->getPlayers());
    }

    /**
     * @param $x
     * @param $y
     * @return bool
     */
    public function hasStone($x, $y)
    {
        return !empty($this->getStoneByCoord($x, $y));
    }

    /**
     * @param $x
     * @param $y
     * @return array
     */
    public function getStoneByCoord($x, $y)
    {
        return array_filter($this->stones, function ($stone) use ($x, $y) {
            return $x === $stone['x'] && $y === $stone['y'];
        });
    }

    /**
     * @param $x
     * @param $y
     * @return string
     */
    public function getPlayerTypeByCoords($x, $y): string
    {
        $type = '';

        if ($stone = $this->getStoneByCoord($x, $y)) {
            $player = array_shift($stone)['player'];
            $type = array_keys($player)[0];
        }

        return $type;
    }

    /**
     * @param int $x
     * @param int $y
     * @param $player
     * @return bool
     */
    public function addStone(int $x, int $y, $player): bool
    {
        $isStoneInBounds = $this->isStoneInBounds($x, $y);

        $alreadyPlayedMove = in_array([$x, $y], $this->stones);
        $isAllowedPlayer = in_array($player, $this->getPlayers());

        if ($isStoneInBounds && !$alreadyPlayedMove && $isAllowedPlayer && $this->isCorrectPlayer($player)) {
            $this->stones[] = ['x' => $x, 'y' => $y, 'player' => $player];

            return true;
        }

        return false;
    }

    /**
     * @param $player
     * @return array
     * @throws \Exception
     */
    public function getPlayerWithType($player): array
    {
        $players = $this->getPlayers();

        $allowedPlayer = array_filter($players, function ($allowedPlayer) use ($player) {
            return in_array($player, $allowedPlayer);
        });

        if (count($allowedPlayer) === 1) {
            return array_shift($allowedPlayer);
        }

        throw new \Exception('Player not found');
    }

    /**
     * This function switch the current player.
     *
     * @return Game
     */
    public function switchPlayer(): Game
    {
        if ($this->currentPlayer === static::PLAYER_1)
            $this->currentPlayer = static::PLAYER_2;
        else {
            $this->currentPlayer = static::PLAYER_1;
        }

        return $this;
    }

    /**
     * @param array $player
     * @return bool
     */
    public function isCorrectPlayer(array $player): bool
    {
        return $this->currentPlayer === key($player);
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
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param array $player
     */
    public function addPlayer(array $player): void
    {
        $this->players[] = $player;
    }

    /**
     * @param mixed $players
     * @return Game
     */
    public function setplayers($players): Game
    {
        $this->players = $players;

        return $this;
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function isStoneInBounds(int $x, int $y): bool
    {
        $limitMin = 0;
        $limitMax = $this->getSize() - 1;
        return min($x, $y) >= $limitMin && max($x, $y) <= $limitMax;
    }


}

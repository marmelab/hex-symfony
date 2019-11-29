<?php

namespace App\Services;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class GameManager
 * @package App\Services
 */
class GameManager
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return Game
     */
    public function createGame()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    /**
     * @param Game $game
     * @param array $coords
     * @param string $player
     * @return Game
     * @throws \Exception
     */
    public function addStoneFromCoordonates(Game $game, array $coords, string $player)
    {
        $playerWithRole = $game->getPlayerWithType($player);

        $game->addStone($coords['x'], $coords['y'], $playerWithRole);
        $game->switchPlayer();

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    /**
     * @param Game $game
     * @param array $player
     * @return Game
     */
    public function addPlayerToGame(Game $game, array $player)
    {
        if (!$game->hasEnoughPlayer()) {
            $game->addPlayer($player);
        }

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    /**
     * @param array $players
     * @param string $playerHash
     * @return string
     */
    public function getPlayerType(array $players, string $playerHash): string
    {
        $type = 'spectator';
        foreach ($players as $player) {
            if (array_search($playerHash, $player)) {
                $type = str_replace('_', ' ', key($player));
            }
        }

        return $type;
    }

}

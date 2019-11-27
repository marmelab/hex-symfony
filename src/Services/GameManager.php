<?php

namespace App\Services;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @param array $players
     * @return Game
     */
    public function createGame(array $players)
    {
        $game = new Game(Game::BOARD_MINI_SIZE, $players);

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    /**
     * @param Game $game
     * @param array $coords
     * @param string $player
     * @return Game
     */
    public function addStoneFromCoordonates(Game $game, array $coords, string $player )
    {
        $game->addStone($coords['x'], $coords['y'], $player);

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

}

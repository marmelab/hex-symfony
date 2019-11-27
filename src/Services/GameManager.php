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
     * @param Request $request
     * @return Game
     */
    public function updateStones(Game $game, Request $request)
    {
        list($x, $y) = explode(',', array_key_first($request->request->all()));

        $game->addStone($x, $y);

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

}

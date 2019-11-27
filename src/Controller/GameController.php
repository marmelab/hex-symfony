<?php

namespace App\Controller;

use App\Entity\Game;
use App\Services\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HexController
 * @package App\Controller
 */
class GameController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('game/index.html.twig');
    }

    /**
     * @param GameManager $gm
     * @return Response
     */
    public function new(GameManager $gm)
    {
        $game = $gm->createGame();

        return $this->redirectToRoute('show_game', ['id' => $game->getId()]);
    }

    /**
     * @param Game $game
     * @param Request $request
     * @param GameManager $gm
     * @return Response
     */
    public function putStone(Game $game, Request $request, GameManager $gm)
    {
        $game = $gm->updateStones($game, $request);

        return $this->redirectToRoute('show_game', ['id' => $game->getId()]);
    }


    /**
     * @param Game $game
     * @return Response
     */
    public function show(Game $game)
    {
        return $this->render('game/game.html.twig', ['game' => $game]);
    }

}

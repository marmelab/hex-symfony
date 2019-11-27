<?php

namespace App\Controller;

use App\Entity\Game;
use App\Services\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param Request $request
     * @return Response
     */
    public function new(GameManager $gm, Request $request)
    {
        $game = $gm->createGame();

        $player = $this->associatePlayerToGame();
        if ($game->hasEnoughPlayer()) {
            $game->addPlayer($player);
        }

        $response = $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        $response->headers->setCookie(new Cookie('p', base64_encode($player)));

        return $response;
    }

    protected function associatePlayerToGame()
    {
        return hash('sha256', uniqid(), false);
    }

    /**
     * @param Game $game
     * @return RedirectResponse
     */
    public function join(Game $game)
    {
        $player = $this->associatePlayerToGame();
        if ($game->hasEnoughPlayer()) {
            $game->addPlayer($player);
        }

        $response = $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        $response->headers->setCookie(new Cookie('p', base64_encode($player)));

        return $response;
    }

    /**
     * @param Game $game
     * @param Request $request
     * @param GameManager $gm
     * @return Response
     */
    public function putStone(Game $game, Request $request, GameManager $gm)
    {
        list($x, $y) = explode(',', $request->request->get('stone'));

        $game = $gm->addStoneFromCoordonates($game, ['x' => $x, 'y' => $y], 'test2');

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

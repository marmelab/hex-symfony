<?php

namespace App\Controller;

use App\Entity\Game;
use App\Services\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
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
        $time = time();

        $players = [
            'p1' => hash('sha256', 'P1' . $time, false),
            'p2' => hash('sha256', 'P2' . $time, false),
        ];
        $game = $gm->createGame($players);

        $response = $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        $response->headers->setCookie(new Cookie('p', base64_encode(json_encode($players['p1']))));

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

<?php

namespace App\Controller;

use App\Entity\Game;
use App\Services\GameManager;
use Hex\Graph;
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
     * @param GameManager $gameManager
     * @param Request $request
     * @return Response
     */
    public function new(GameManager $gameManager, Request $request)
    {
        $game = $gameManager->createGame();

        $player = $this->getPlayerHash();
        $gameManager->addPlayerToGame($game, [Game::PLAYER_1 => $player]);

        $response = $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        $response->headers->setCookie(new Cookie('p', base64_encode($player)));

        return $response;
    }

    protected function getPlayerHash()
    {
        return hash('sha256', uniqid(), false);
    }

    /**
     * @param Game $game
     * @param GameManager $gameManager
     * @return RedirectResponse
     */
    public function join(Game $game, GameManager $gameManager)
    {
        $player = $this->getPlayerHash();
        $gameManager->addPlayerToGame($game, [Game::PLAYER_2 => $player]);

        $response = $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        $response->headers->setCookie(new Cookie('p', base64_encode($player)));

        return $response;
    }

    /**
     * @param Game $game
     * @param Request $request
     * @param GameManager $gameManager
     * @return Response
     */
    public function putStone(Game $game, Request $request, GameManager $gameManager)
    {
        $errors = null;
        list($x, $y) = explode(',', $request->request->get('stone'));
        $player = base64_decode($request->cookies->get('p'));

        try {
            $game = $gameManager->addStoneFromCoordonates($game, ['x' => $x, 'y' => $y], $player);
        } catch (\Exception $exception) {
            $errors = $exception->getMessage();
        }

        $wonBy = $gameManager->checkGame($game);

        return $this->redirectToRoute('show_game', ['id' => $game->getId(), 'errors' => $errors, 'won_by' => $wonBy]);
    }

    /**
     * @param Game $game
     * @param Request $request
     * @param GameManager $gameManager
     * @return Response
     */
    public function show(Game $game, Request $request, GameManager $gameManager)
    {
        $playerHash = base64_decode($request->cookies->get('p'));
        $player = $gameManager->getPlayerType($game->getPlayers(), $playerHash);

        return $this->render('game/game.html.twig', ['game' => $game, 'player' => $player]);
    }


}

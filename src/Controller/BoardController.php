<?php

namespace App\Controller;

use App\Services\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BoardController
 * @package App\Controller
 */
class BoardController extends AbstractController
{

    /**
     * @param Request $request
     * @param GameManager $gameManager
     * @return Response
     */
    public function index(Request $request, GameManager $gameManager)
    {
        $gameManager
            ->init()
            ->addStone($request->request->all());

        return $this->render('board.index.html.twig', ['board' => $gameManager->getBoard()]);
    }
}

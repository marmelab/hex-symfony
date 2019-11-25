<?php

namespace App\Controller;

use App\Entity\Board;
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
     * @return Response
     */
    public function index(Request $request)
    {
        $board = new Board(5);

        return $this->render('board.index.html.twig', ['size' => $board->getSize()]);
    }
}
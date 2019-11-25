<?php

namespace App\Controller;

use App\Entity\Board;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BoardController
 * @package App\Controller
 */
class BoardController extends AbstractController
{
    /**
     * @return Response
     */
    public function index()
    {
        $board = new Board(11);

        return $this->render('board.index.html.twig', ['size' => $board->getSize()]);
    }
}
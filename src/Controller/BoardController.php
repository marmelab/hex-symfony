<?php

namespace App\Controller;

use App\Entity\Board;
use Hex\Board as BaseBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BoardController
 * @package App\Controller
 */
class BoardController extends AbstractController
{

    /**
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        $board = $this->getDoctrine()
            ->getRepository(Board::class)
            ->find($id);

        if (!$board) {
            $board = new Board(BaseBoard::MINI_SIZE);
        }

        return $this->render('board/board.html.twig', ['board' => $board]);
    }
}

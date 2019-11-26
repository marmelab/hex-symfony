<?php

namespace App\Controller;

use App\Entity\Board;
use App\Services\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HexController
 * @package App\Controller
 */
class HexController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('board/board.html.twig');
    }

}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hex\Game as BaseGame;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game extends BaseGame
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="json", name="stones")
     */
    protected $stones;

    /**
     * @ORM\Column(type="json", name="players")
     */
    protected $players;

    /**
     * @ORM\Column(type="smallint", name="size", options={"default":11})
     */
    protected $size;

    /**
     * @ORM\Column(type="string", name="current_player")
     */
    protected $currentPlayer;
}

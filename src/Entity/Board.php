<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hex\Board as BaseBoard;

/**
 * Class Board
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\BoardRepository")
 */
class Board extends BaseBoard
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    protected $stones = [];

    /**
     * @ORM\Column(type="integer")
     */
    protected $size;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array|null
     */
    public function getStones(): ?array
    {
        return $this->stones;
    }

    /**
     * @param array $stones
     * @return $this
     */
    public function setStones(array $stones): self
    {
        $this->stones = $stones;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }
}

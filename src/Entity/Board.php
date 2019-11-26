<?php

namespace App\Entity;


/**
 */
class Board
{

    /**
     * @var int
     */
    protected $size;

    /**
     * @var array
     */
    protected $stones;

    /**
     * Board constructor.
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return array
     */
    public function getStones(): array
    {
        return $this->stones;
    }

    /**
     * @param array $stones
     */
    public function setStones(array $stones): void
    {
        $this->stones = $stones;
    }

}
<?php

namespace App\Entity;


/**
 * Class Stone
 * @package App\Entity
 */
class Stone
{
    /**
     * @var int
     */
    public $x;

    /**
     * @var int
     */
    public $y;

    /**
     * Stone constructor.
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

}

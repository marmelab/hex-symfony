<?php

namespace Tests\Hex;

use Ds\Set;
use Hex\Connection;
use Hex\Game;
use PHPUnit\Framework\TestCase;

/**
 * Class ConnectionTest
 * @package Tests\Hex
 * @coversDefaultClass \Hex\Connection
 */
class ConnectionTest extends TestCase
{

    /**
     * @test
     * @covers ::loadWithCoords
     */
    public function can_get_all_starting_point_of_graph()
    {
        $graph = new Connection();

        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([['x' => 0, 'y' => 1]]);

        $actual = $graph->loadWithCoords(0, 0, $game);
        $expected = new Set();
        $expected->add('0,1');

        $this->assertEquals($expected, $actual->getNeighbors());
        $this->assertEquals('0,0', $actual->getPoint());
    }

}

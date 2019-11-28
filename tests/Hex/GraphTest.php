<?php

namespace Tests\Hex;

use Ds\Set;
use Hex\Game;
use Hex\Graph;
use PHPUnit\Framework\TestCase;

/**
 * Class GraphTest
 * @package He
 * @coversDefaultClass \Hex\Graph
 */
class GraphTest extends TestCase
{

    /**
     *
     * @covers ::hasChain
     */
    public function can_determine_if_a_chain_is_present()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 1],
            ["x" => 0, "y" => 2],
            ["x" => 0, "y" => 3],
            ["x" => 0, "y" => 4],
        ]);

        $graph = new Graph();
        $graph->loadFromGame($game);

        $this->assertTrue($graph->hasChain());
    }

    /**
     * @test
     * @covers ::hasChain
     */
    public function can_determine_if_a_chain_is_not_present()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 1],
            ["x" => 0, "y" => 3],
            ["x" => 0, "y" => 4],
        ]);

        $graph = new Graph();
        $graph->loadFromGame($game);

        $this->assertFalse($graph->hasChain());
    }

    /**
     * @test
     * @covers ::getStartNeighbors
     */
    public function can_get_all_starting_point_of_graph()
    {
        $graph = new Graph();
        $actual = $graph->getStartNeighbors(3);
        $expected = new Set();
        $expected->add('0,0');
        $expected->add('0,1');
        $expected->add('0,2');

        $this->assertEquals($actual, $expected);
    }

    /**
     * @covers ::loadFromGame
     */
    public function can_load_a_graph_with_a_game_object()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([['x' => 0, 'y' => 1]]);

        $graph = new Graph();
        $graph->loadFromGame($game);

        $expected = new Set();
        $expected->add('0,0');
        $expected->add('0,1');
        $expected->add('0,2');

        $this->assertEquals($graph, $expected);
    }

}

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
     * @test
     * @covers ::hasChain
     */
    public function can_determine_if_a_chain_is_present()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);

        $player1Stones = [
            ["x" => 0, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 1, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 2, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 3, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 4, "y" => 0, 'player' => Game::PLAYER_1],
        ];

        $game->setStones($player1Stones);

        $graph = new Graph();

        $this->assertEquals(Game::PLAYER_1, $graph->hasChain($game));
    }

    /**
     * @test
     * @covers ::hasChain
     */
    public function can_determine_if_a_chain_is_not_present()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([
            ["x" => 0, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 1, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 2, "y" => 0, 'player' => Game::PLAYER_1],
            ["x" => 3, "y" => 0, 'player' => Game::PLAYER_2],
            ["x" => 4, "y" => 0, 'player' => Game::PLAYER_2],
        ]);

        $graph = new Graph();

        $this->assertNull($graph->hasChain($game));
    }

    /**
     * @test
     * @covers ::getStartNeighbors
     */
    public function can_get_all_starting_point_of_graph()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([['x' => 0, 'y' => 1, 'player' => 'player_1']]);

        $graph = new Graph();
        $actual = $graph->getStartNeighbors($game);

        $this->assertEquals($actual, ['start' => ['0,1']]);
    }

    /**
     * @test
     * @covers ::getEndNeighbors
     */
    public function can_get_all_ending_point_of_graph()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);
        $game->setStones([['x' => 4, 'y' => 4, 'player' => 'player_1']]);

        $graph = new Graph();
        $actual = $graph->getEndNeighbors($game);

        $this->assertEquals($actual, ['4,4' => 'end']);
    }

}

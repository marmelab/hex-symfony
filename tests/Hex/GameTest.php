<?php


namespace App\Tests\Hex;


use Hex\Game;
use Monolog\Test\TestCase;

/**
 * Class GameTest
 * @package App\Tests\Hex
 * @coversDefaultClass \Hex\Game
 */
class GameTest extends TestCase
{

    /**
     * @test
     * @covers ::isStoneInBounds
     */
    public function a_user_cant_add_a_stone_outside_the_board()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);

        $this->assertFalse($game->isStoneInBounds(-1, 2));
        $this->assertFalse($game->isStoneInBounds(10, 1));
    }

    /**
     * @test
     * @covers ::getStonesByPlayerTypes
     */
    public function an_user_can_get_stones_of_a_specific_player()
    {
        $game = new Game(Game::BOARD_MINI_SIZE);

        $game->setStones([
            ['x' => 0, 'y' => 0, 'player' => Game::PLAYER_1],
            ['x' => 1, 'y' => 1, 'player' => Game::PLAYER_2],
            ['x' => 2, 'y' => 2, 'player' => Game::PLAYER_1]
        ]);

        $this->assertSame(
            [
                ['x' => 0, 'y' => 0, 'player' => Game::PLAYER_1],
                ['x' => 2, 'y' => 2, 'player' => Game::PLAYER_1]
            ], $game->getStonesByPlayerTypes(Game::PLAYER_1)
        );

        $this->assertSame([['x' => 1, 'y' => 1, 'player' => Game::PLAYER_2]],
            $game->getStonesByPlayerTypes(Game::PLAYER_2)
        );
    }

}

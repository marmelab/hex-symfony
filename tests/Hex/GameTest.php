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

}

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
     * @covers ::addStone
     */
    public function a_user_can_add_a_stone()
    {
        $game = new Game(5);

        $game->addStone(0, 0);
        $this->assertContains([0, 0], $game->getStones());

        $game->addStone(4, 4);
        $this->assertContains([4, 4], $game->getStones());
    }

    /**
     * @test
     * @covers ::addStone
     */
    public function a_user_cant_add_a_stone_in_already_used_place()
    {
        $game = new Game(5);

        $game->addStone(0, 0);
        $this->assertContains([0, 0], $game->getStones());

        $game->addStone(0, 0);
        $this->assertEquals(1, count($game->getStones()));
    }

    /**
     * @test
     * @covers ::addStone
     */
    public function a_user_cant_add_a_stone_outside_the_board()
    {
        $game = new Game(5);

        $game->addStone(-1, 10);

        $this->assertNotContains([-1, 10], $game->getStones());

        $game->addStone(10, -1);
        $this->assertNotContains([10, -1], $game->getStones());
    }


}

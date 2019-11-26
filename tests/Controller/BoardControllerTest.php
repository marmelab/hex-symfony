<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BoardControllerTest
 * @package App\Tests\Controller
 */
class BoardControllerTest extends WebTestCase
{

    /**
     * @test
     */
    public function asUserICanRenderABoard()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }

}
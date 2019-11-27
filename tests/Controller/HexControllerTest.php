<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class HexControllerTest
 * @package App\Tests\Controller
 */
class HexControllerTest extends WebTestCase
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

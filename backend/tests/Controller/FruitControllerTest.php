<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FruitControllerTest extends WebTestCase
{
    public function testGetAllFruits(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fruit');

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $data = $response->getContent();
        $this->assertStringContainsString("Symfony and PHP", $data);
    }
}

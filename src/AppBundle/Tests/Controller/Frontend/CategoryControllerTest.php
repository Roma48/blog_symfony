<?php

namespace AppBundle\Tests\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/category/random/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

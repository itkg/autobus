<?php

namespace Tests\BusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobController extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/jobs');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Autobus', $crawler->filter('.navbar-brand')->text());
    }
}

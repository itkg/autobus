<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlRedirectProvider
     *
     * @param string $url
     */
    public function testPageIsRedirect($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isRedirection());
        $client->followRedirect();

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlRedirectProvider()
    {
        return array(
            array(''),
            array('/'),
            array('/job'),
        );
    }

    /**
     * @dataProvider urlProvider
     *
     * @param string $url
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/job/new'),
        );
    }
}

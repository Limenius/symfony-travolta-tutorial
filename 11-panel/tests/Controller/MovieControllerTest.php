<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Pulp Fiction")')->count()
        );

        $this->assertGreaterThan(
            0,
            $crawler->filter('div.list')->count()
        );
    }

    public function testNewEnquiry()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/enquiry');

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        $this->assertGreaterThan(
            0,
            $crawler->filter('div.form-container')->count()
        );
    }
}
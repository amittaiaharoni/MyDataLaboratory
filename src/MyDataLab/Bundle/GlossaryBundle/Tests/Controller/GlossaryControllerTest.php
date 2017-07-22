<?php

namespace MyDataLab\Bundle\GlossaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GlossaryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}');
    }

    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}');
    }

    public function testPreview()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/preview/{id}');
    }

}

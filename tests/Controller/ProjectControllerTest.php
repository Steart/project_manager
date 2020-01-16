<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase
{
    public function testIfNotAnonymouslyAssessable()
    {
        $client = static::createClient();

        $client->request('GET', '/projects');

        // Match 302 because redirect to login page
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
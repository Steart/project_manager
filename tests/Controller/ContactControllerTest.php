<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testIfNotAnonymouslyAssessable()
    {
        $client = static::createClient();

        $client->request('GET', '/contacts');
        
        // Match 302 because redirect to login page
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
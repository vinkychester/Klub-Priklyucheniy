<?php

namespace App\Tests\Service;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    #[NoReturn] public function testPOST()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            'http://localhost/api/calculate-discount',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"basePrice":10000, "dateOfBirth":"01.01.2020", "dateTravelStart":"01.01.2024", "dateOfPayment":null}'

        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class EndpointsTest extends WebTestCase
{

   /**
    * 
    *@dataProvider getJSonDAta
    */
    public function testEditSubscription($jsonData)
    {   
        $client = static::createClient();
        $client->request('PUT', '/subscription/1', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Subscription updated', $client->getResponse()->getContent());
    }

    /**
    * 
    *@dataProvider getJSonDAta
    */
    public function testCreateSubscription($jsonData)
    {   
        $client = static::createClient();
        $client->request('POST', '/subscription', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Subscription created', $client->getResponse()->getContent());
    }


    public function getJsonData():iterable
    {
        yield [
            '{
                "idContact": "1",
                "idProduct": "1",
                "beginDate": "2020-05-17 12:30:45",
                "endDate": "2024-04-10 12:30:45"
            }'
        ];
    }
}

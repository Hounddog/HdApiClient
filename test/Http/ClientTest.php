<?php

namespace HDTest\Api\Client\Http;

use PHPUnit_Framework_TestCase;
use HD\Api\Client\Http\Client;
use Zend\EventManager\EventManager;

class ClientTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    public function setUp()
    {
        $options = array(
            'base_url' => 'https://api.com/',
            'api_version' => 'v1',
            'timeout'     => 10,
        );
        $this->client = new Client($options);

        $adapter = new \Zend\Http\Client\Adapter\Test();
        $adapter->setResponse(
            "HTTP/1.1 200 OK"      . "\r\n" .
            "Status: 200 OK"             . "\r\n" .
            "Content-Type: application/json; charset=utf-8" . "\r\n" .
            "\r\n" .
            '{'.
            '    "id": 1,'.
            '    "name": "EdpGithub",'.
            '}'
        );
        
        $this->client->setHttpAdapter($adapter);

        $eventManager = new EventManager();
        $this->client->setEventManager($eventManager);

    }

    public function tearDown()
    {
        // your code here
    }

    public function testGet()
    {
        $response = $this->client->get('user');
        $this->assertInstanceOf('Zend\Http\Response', $response);
    }

    public function testPost()
    {
        $response = $this->client->post('user');
        $this->assertInstanceOf('Zend\Http\Response', $response);
    }
}

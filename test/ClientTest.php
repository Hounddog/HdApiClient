<?php

namespace HDTest\Api\Client;

use HD\Api\Client\Client;
use Zend\ServiceManager\ServiceManager;
use Zend\EventManager\EventManager;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected $serviceManager;

    public function setUp()
    {
        $this->serviceManager = new ServiceManager();
        $this->serviceManager->setService('HD\Api\Client\HttpClient', $this->getHttpClient('foo', 'bar'));
        $this->serviceManager->setService(
            'HD\Api\Client\Listener\Error',
            $this->getMock('HD\Api\Client\Listener\Error')
        );
        $this->serviceManager->setService(
            'HD\Api\Client\Listener\Cache',
            $this->getMock('HD\Api\Client\Listener\Cache')
        );
    }

    public function getHttpClient($path)
    {
        $response = $this->getMock('Zend\Http\Response');
        $eventManager = new EventManager();

        $httpClient = $this->getMock('HD\Api\Client\Http\Client');
        $httpClient->expects($this->any())
            ->method('get')
            ->with($path)
            ->will($this->returnValue($response));

        $httpClient->expects($this->any())
            ->method('getEventManager')
            ->will($this->returnValue($eventManager));

        return $httpClient;
    }

    public function testGet()
    {
        $this->client= new Client();
        $this->client->setHttpClient($this->getHttpClient('test/path'));

        $result = $this->client->getHttpClient()->get('test/path');
        $this->assertInstanceOf('Zend\Http\Response', $result);
    }

    public function testAuthenticate()
    {
        $authListener = $this->getMock('HD\Api\Client\Listener\Auth\UrlToken');
        $authListener->expects($this->once())
            ->method('setOptions')
            ->with(array(
                'tokenOrLogin' => '12345',
                'password' =>null,
            ));

        $sm = $this->getMock('Zend\ServiceManager\ServiceManager');
        $sm->expects($this->once())
            ->method('get')
            ->with('\Listener\Auth\UrlToken')
            ->will($this->returnValue($authListener));

        $this->client = new Client();
        $this->client->setServiceManager($sm);
        $this->client->setHttpClient($this->getHttpClient('test'));
        $this->client->authenticate('url_token', '12345');
    }

    public function testSetServiceManager()
    {
        $client = new Client();
        $client->setServiceManager($this->serviceManager);

        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $client->getServiceManager());
    }

    public function testGetHttpClient()
    {
        $client = new Client();
        $client->setServiceManager($this->serviceManager);

        $httpClient = $client->getHttpClient();

        $this->assertInstanceOf('HD\Api\Client\Http\Client', $httpClient);
    }

    public function testSetEventManager()
    {
        $client = new Client();
        $result = $client->setEventManager(new EventManager);

        $this->assertInstanceOf('HD\Api\Client\Client', $result);
    }
}

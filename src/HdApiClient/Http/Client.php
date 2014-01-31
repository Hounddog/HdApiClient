<?php

namespace HdApiClient\Http;

use Zend\Http\Client as HttpClient;
use Zend\Http\Client\Adapter\Curl;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

class Client implements EventManagerAwareInterface, ClientInterface
{
    /*
     * EventManager
     */
    protected $events;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var Curl
     */
    protected $httpAdapter;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    private $options;

    public function __construct($options) {
        $this->setOptions($options);
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function getOptions() {
        return $this->options;
    }

    /**
     * Get Request
     *
     * @param  string $path
     * @param  array  $parameters
     * @param  array  $headers
     * @return Zend\Http\Response
     */
    public function get($path, array $parameters = array(), array $headers = array())
    {
        return $this->request($path, $parameters, 'GET', $headers);
    }

    /**
     * Send POST Request
     *
     * @param  string $path
     * @param  array  $parameters
     * @param  array  $headers
     * @return Zend\Http\Response
     */
    public function post($path, array $parameters = array(), array $headers = array())
    {
        var_dump($parameters);
        return $this->request($path, $parameters, 'POST', $headers);
    }

    /**
     * Send Delete Request
     *
     * @param  string $path
     * @param  array  $parameters
     * @param  array  $headers
     * @return Zend\Http\Response
     */
    public function delete($path, array $parameters = array(), array $headers = array())
    {
        return $this->request($path, $parameters, 'DELETE', $headers);
    }

    /**
     * Send Put Request
     *
     * @param  string $path
     * @param  array  $headers
     * @return Zend\Http\Response
     */
    public function put($path, array $headers = array())
    {
        return $this->request($path, array(), 'PUT', $headers);
    }

    /**
     * Send Request
     *
     * @param  string $path
     * @param  array  $parameters
     * @param  string $httpMethod
     * @param  array  $headers
     * @return Zend\Http\Response
     */
    public function request($path, array $parameters = array(), $httpMethod = 'GET', array $headers = array())
    {
        $client = $this->getHttpClient($path);
        //var_dump($client);exit;
        $request = $client->getRequest();

        if($httpMethod == 'GET') {
            $query = $request->getQuery();

            foreach($parameters as $key => $value) {
                $query->set($key, $value);
            }
        } elseif($httpMethod == 'POST') {
            $client->setEncType('multipart/form-data');
            $request->setMethod('POST');
            $post = $request->getPost();

            foreach($parameters as $key => $value) {
                $post->set($key, $value);
            }
        }
        
        //Trigger Pre Send Event to modify Request Object
        $this->getEventManager()->trigger('pre.send', $request);

        //echo "<pre>";
        //print_r($request);
        //exit;
        $response = $client->dispatch($request);
        //$this->response = $response;
        //echo "<pre>";
        //print_r($response);
        //echo $response->getBody();
        //exit;
        //Trigger Post Send to Modify/Validate Response object
        $result = $this->getEventManager()->trigger('post.send', $response);
        if($result->stopped()) {
            $response = $result->last();
        }

        $this->request = $request;

        return $response;
    }

    /**
     * Get Http Client
     *
     * @param  string $path
     * @return HttpClient
     */
    public function getHttpClient($path)
    {
        if(null === $this->httpClient) {
            $this->httpClient = new HttpClient();
            $this->httpClient->setAdapter($this->getHttpAdapter());
        }
        $this->httpClient->setUri($this->options['base_url'] . $this->options['api_version'] . '/' . $path);
        return $this->httpClient;
    }

    /**
     * Get Http Adapter
     * @return
     */
    public function getHttpAdapter()
    {
        if(null === $this->httpAdapter){
            $this->httpAdapter = new Curl();
            $this->httpAdapter->setOptions(array(
                'sslverifypeer' =>false,
            ));
        }
        return $this->httpAdapter;
    }

    public function setHttpAdapter($adapter)
    {
        $this->httpAdapter = $adapter;
    }

    /**
     * Set Event Manager
     *
     * @param  EventManagerInterface $events
     * @return HybridAuth
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->events = $events;
        return $this;
    }

    /**
     * Get Event Manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->events;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getRequest()
    {
        return $this->request;
    }
}

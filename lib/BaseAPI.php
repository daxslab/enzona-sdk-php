<?php

namespace daxslab\enzona;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;

class BaseAPI
{

    /**
     * The Payment API host
     *
     * @var string
     */
    protected $host = '';

    /**
     * The default Payment API host
     *
     * @var string
     */
    protected $apiHost = 'https://api.enzona.net';

    /**
     * The default Payment API Sandbox host
     *
     * @var string
     */
    protected $apiSandboxHost = 'https://apisandbox.enzona.net';

    /**
     * The API route in host
     *
     * @var string
     */
    protected $apiRoute = '';

    /**
     * The route for requesting access token in host
     *
     * @var string
     */
    protected $accessTokenRoute = '/token';

    /**
     * Define if SDK will use the EnZona sandbox
     *
     * @var string
     */
    protected $useSandbox;

    /**
     * HTTP client
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * Payment API configuration object
     *
     * @var Configuration
     */
    protected $config;

    /**
     * HeaderSelector object
     *
     * @var HeaderSelector
     */
    protected $headerSelector;


    /**
     * EnZona constructor.
     * @param bool $useSandbox
     * @param null $config
     */
    public function __construct($useSandbox=false, $client=null, $config=null, $headerSelector=null)
    {
        $this->useSandbox = $useSandbox;
        $this->client = $client;
        $this->config = $config;
        $this->headerSelector= $headerSelector;

        $this->host = $this->useSandbox ? $this->apiSandboxHost : $this->apiHost;

    }

    /**
     * Return the API Host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the API Host
     *
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
        $this->config->setHost($this->host . $this->apiRoute);
    }

    /**
     * @return string
     */
    public function getApiRoute()
    {
        return $this->apiRoute;
    }

    /**
     * @param string $apiRoute
     */
    public function setApiRoute($apiRoute)
    {
        $this->apiRoute = $apiRoute;
    }

    /**
     * @return string
     */
    public function getAccessTokenRoute()
    {
        return $this->accessTokenRoute;
    }

    /**
     * @param string $accessTokenRoute
     */
    public function setAccessTokenRoute($accessTokenRoute)
    {
        $this->accessTokenRoute = $accessTokenRoute;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Configuration $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return HeaderSelector
     */
    public function getHeaderSelector()
    {
        return $this->headerSelector;
    }

    /**
     * @param HeaderSelector $headerSelector
     */
    public function setHeaderSelector($headerSelector)
    {
        $this->headerSelector = $headerSelector;
    }

    /**
     * Requests an access token and return it
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function requestAccessToken($customer_key, $customer_secret){
        $client = new Client();
        $res = $client->request('POST', $this->host . $this->accessTokenRoute, [
            'auth' => [$customer_key, $customer_secret],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        if ($res->getStatusCode() != 200)
            throw new \Exception('Error with status code: '. $res->getStatusCode() . 'and body: ' . $res->getBody());
        elseif ($res->getHeader('content-type')[0] != 'application/json')
            throw new \Exception('Invalid response content-type: '. $res->getHeader('content-type')[0] . ' required: application/json');

        return json_decode($res->getBody())->access_token;
    }

    /**
     * Set the API access token
     *
     * @param string $token
     */
    public function setAccessToken($token)
    {
        $this->config->setAccessToken($token);
    }

}
<?php

namespace daxslab\enzona;

use GuzzleHttp\ClientInterface;

class BaseAPI
{

    /**
     * The Payment API host
     *
     * @var string
     */
    protected $host = '';

    /**
     * The Payment API Sandbox host
     *
     * @var string
     */
    protected $sandboxHost = '';


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
     * Set the API access token
     *
     * @param string $token
     */
    public function setAccessToken($token)
    {
        $this->config->setAccessToken($token);
    }

}
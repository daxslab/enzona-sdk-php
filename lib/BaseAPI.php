<?php

namespace daxslab\enzona;

use daxslab\enzona\payment\Configuration as PaymentConfiguration;
use daxslab\enzona\payment\HeaderSelector as PaymentHeaderSelector;
use daxslab\enzona\qr\Configuration as QrConfiguration;
use daxslab\enzona\qr\HeaderSelector as QrHeaderSelector;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class BaseAPI
{

    const SCOPE_PAYMENT = 'enzona_business_payment';
    const SCOPE_QR = 'enzona_business_qr';

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
     * @var PaymentConfiguration | QrConfiguration
     */
    protected $config;

    /**
     * HeaderSelector object
     *
     * @var PaymentHeaderSelector | QrHeaderSelector
     */
    protected $headerSelector;


    /**
     * EnZona constructor.
     * @param bool $useSandbox
     * @param ClientInterface $client
     * @param PaymentConfiguration | QrConfiguration $config
     * @param PaymentHeaderSelector | QrHeaderSelector $headerSelector
     */
    public function __construct($useSandbox=false, $client=null, $config=null, $headerSelector=null)
    {
        $this->useSandbox = $useSandbox;
        $this->client = $client ?: new Client();
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
     * @return PaymentConfiguration | QrConfiguration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param PaymentConfiguration | QrConfiguration $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return PaymentHeaderSelector | QrHeaderSelector
     */
    public function getHeaderSelector()
    {
        return $this->headerSelector;
    }

    /**
     * @param PaymentHeaderSelector | QrHeaderSelector $headerSelector
     */
    public function setHeaderSelector($headerSelector)
    {
        $this->headerSelector = $headerSelector;
    }

    /**
     * Requests an access token and return it
     *
     * @param string $customer_key
     * @param string $customer_secret
     * @param array $scopes
     * @return string
     * @throws GuzzleException
     * @throws Exception
     */
    public function requestAccessToken($customer_key, $customer_secret, $scopes=[self::SCOPE_PAYMENT]){
        $body_scope = implode('+', $scopes);
        $res = $this->client->request('POST', $this->host . $this->accessTokenRoute, [
            'auth' => [$customer_key, $customer_secret],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'body' => "grant_type=client_credentials&scope=$body_scope",
        ]);

        if ($res->getStatusCode() != 200)
            throw new Exception('Error with status code: '. $res->getStatusCode() . 'and body: ' . $res->getBody());
        elseif ($res->getHeader('content-type')[0] != 'application/json')
            throw new Exception('Invalid response content-type: '. $res->getHeader('content-type')[0] . ' required: application/json');

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
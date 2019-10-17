<?php

namespace daxslab\enzona;


use daxslab\enzona\payment\HeaderSelector;
use daxslab\enzona\qr\api\ObtieneLaInformacinDeUnQRApi;
use daxslab\enzona\qr\api\PermiteCrearUnQRDePagoAUnComercioApi;
use daxslab\enzona\qr\api\PermiteCrearUnQRParaHacerUnPagoEntrePersonas_Api;
use daxslab\enzona\qr\Configuration;
use GuzzleHttp\ClientInterface;

class QrAPI extends BaseAPI
{

    /**
     * The API route in host
     *
     * @var string
     */
    protected $apiRoute = '/qr/v1.0.0';

    /**
     * Payment API configuration object
     *
     * @var Configuration
     */
    protected $config;


    /**
     * PaymentAPI constructor.
     * If $client, $config and $headerSelector parameters are set to null, default instances will be created.
     *
     * @param bool $useSandbox
     * @param ClientInterface $client
     * @param Configuration $config
     * @param HeaderSelector $headerSelector
     */
    public function __construct($useSandbox = false, $client=null, $config=null, $headerSelector=null)
    {
        parent::__construct($useSandbox, $client, $config, $headerSelector);

        if ($config) {
            $this->config = $config;
        } else {
            $this->config = new Configuration();
            $this->config->setHost($this->host . $this->apiRoute);
        }
    }

    /**
     * Returns a create commerce payment QR API Object
     *
     * @return PermiteCrearUnQRDePagoAUnComercioApi
     */
    public function createQrMerchant(){
        return new PermiteCrearUnQRDePagoAUnComercioApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a create persons payment QR API Object
     *
     * @return PermiteCrearUnQRParaHacerUnPagoEntrePersonas_Api
     */
    public function createQrAccount(){
        return new PermiteCrearUnQRParaHacerUnPagoEntrePersonas_Api($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a QR information API Object
     *
     * @return ObtieneLaInformacinDeUnQRApi
     */
    public function qrCode(){
        return new ObtieneLaInformacinDeUnQRApi($this->client, $this->config, $this->headerSelector);
    }






}
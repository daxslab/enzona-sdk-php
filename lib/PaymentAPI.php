<?php

namespace daxslab\enzona;


use daxslab\enzona\payment\api\ListaDeDevolucionesDeUnPagoApi;
use daxslab\enzona\payment\api\ObtieneListadoDePagosRealizadosApi;
use daxslab\enzona\payment\api\ObtieneLosDetallesDeUnaDevolucinRealizadaApi;
use daxslab\enzona\payment\api\ObtieneLosDetallesDeUnPagoRealizadoApi;
use daxslab\enzona\payment\api\ObtieneUnaListaDeDevolucionesRealizadasApi;
use daxslab\enzona\payment\api\PermiteCancelarUnPagoApi;
use daxslab\enzona\payment\api\PermiteCompletarUnPagoApi;
use daxslab\enzona\payment\api\PermiteConfirmarUnPagoApi;
use daxslab\enzona\payment\api\PermiteCrearUnPagoApi;
use daxslab\enzona\payment\api\PermiteCrearUnRecieveCodeApi;
use daxslab\enzona\payment\api\PermiteRealizarElCheckoutDeUnPagoApi;
use daxslab\enzona\payment\api\PermiteRealizarLaDevolucinDeUnPagoApi;
use daxslab\enzona\payment\Configuration;
use daxslab\enzona\qr\HeaderSelector;
use GuzzleHttp\ClientInterface;

class PaymentAPI extends BaseAPI
{

    /**
     * The API route in host
     *
     * @var string
     */
    protected $apiRoute = '/payment/v1.0.0';

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
     * @inheritDoc
     */
    public function requestAccessToken($customer_key, $customer_secret, $scopes = [self::SCOPE_PAYMENT])
    {
        return parent::requestAccessToken($customer_key, $customer_secret, $scopes);
    }


    /**
     * Returns a create payment API Object
     *
     * @return PermiteCrearUnPagoApi
     */
    public function createPayment(){
        return new PermiteCrearUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a confirm payment API Object
     *
     * @return PermiteConfirmarUnPagoApi
     */
    public function confirmPayment(){
        return new PermiteConfirmarUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a cancel payment API Object
     *
     * @return PermiteCancelarUnPagoApi
     */
    public function cancelPayment(){
        return new PermiteCancelarUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a complete payment API Object
     *
     * @return PermiteCompletarUnPagoApi
     */
    public function completePayment(){
        return new PermiteCompletarUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a list payment API Object
     *
     * @return ObtieneListadoDePagosRealizadosApi
     */
    public function listPayments(){
        return new ObtieneListadoDePagosRealizadosApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a details payment API Object
     *
     * @return ObtieneLosDetallesDeUnPagoRealizadoApi
     */
    public function detailsPayment(){
        return new ObtieneLosDetallesDeUnPagoRealizadoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a checkout payment API Object
     *
     * @return PermiteRealizarElCheckoutDeUnPagoApi
     */
    public function checkoutPayment(){
        return new PermiteRealizarElCheckoutDeUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a refund payment API Object
     *
     * @return PermiteRealizarLaDevolucinDeUnPagoApi
     */
    public function refundPayment(){
        return new PermiteRealizarLaDevolucinDeUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a list of refunds payment API Object
     *
     * @return ListaDeDevolucionesDeUnPagoApi
     */
    public function listRefundsPayment(){
        return new ListaDeDevolucionesDeUnPagoApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a refund details API Object
     *
     * @return ObtieneLosDetallesDeUnaDevolucinRealizadaApi
     */
    public function refundDetails(){
        return new ObtieneLosDetallesDeUnaDevolucinRealizadaApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a refund list API Object
     *
     * @return ObtieneUnaListaDeDevolucionesRealizadasApi
     */
    public function listRefunds(){
        return new ObtieneUnaListaDeDevolucionesRealizadasApi($this->client, $this->config, $this->headerSelector);
    }

    /**
     * Returns a crete receive code API Object
     *
     * @return PermiteCrearUnRecieveCodeApi
     */
    public function createReceiveCode(){
        return new PermiteCrearUnRecieveCodeApi($this->client, $this->config, $this->headerSelector);
    }






}
<?php

namespace daxslab\enzona\test;

use daxslab\enzona\BaseAPI;
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
use daxslab\enzona\PaymentAPI;

class PaymentAPITest extends \PHPUnit_Framework_TestCase
{

    public function test__canBeCreated()
    {
        $paymentAPI = new PaymentAPI();
        $this->assertInstanceOf(
            BaseAPI::class,
            $paymentAPI
        );
        $this->assertEquals(
            'https://api.enzona.net/payment/v1.0.0',
            $paymentAPI->getConfig()->getHost()
        );

    }

    public function test__canBeCreatedAsSandbox()
    {
        $paymentAPI = new PaymentAPI(true);

        $this->assertEquals(
            'https://apisandbox.enzona.net/payment/v1.0.0',
            $paymentAPI->getConfig()->getHost()
        );
    }

    public function testListRefunds()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            ObtieneUnaListaDeDevolucionesRealizadasApi::class,
            $paymentAPI->listRefunds()
        );

    }

    public function testDetailsPayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            ObtieneLosDetallesDeUnPagoRealizadoApi::class,
            $paymentAPI->detailsPayment()
        );

    }

    public function testCheckoutPayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteRealizarElCheckoutDeUnPagoApi::class,
            $paymentAPI->checkoutPayment()
        );
    }

    public function testRefundPayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteRealizarLaDevolucinDeUnPagoApi::class,
            $paymentAPI->refundPayment()
        );
    }

    public function testCreatePayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteCrearUnPagoApi::class,
            $paymentAPI->createPayment()
        );
    }

    public function testRefundDetails()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            ObtieneLosDetallesDeUnaDevolucinRealizadaApi::class,
            $paymentAPI->refundDetails()
        );
    }

    public function testConfirmPayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteConfirmarUnPagoApi::class,
            $paymentAPI->confirmPayment()
        );
    }

    public function testCompletePayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteCompletarUnPagoApi::class,
            $paymentAPI->completePayment()
        );
    }

    public function testListPayments()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            ObtieneListadoDePagosRealizadosApi::class,
            $paymentAPI->listPayments()
        );
    }

    public function testListRefundsPayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            ListaDeDevolucionesDeUnPagoApi::class,
            $paymentAPI->listRefundsPayment()
        );
    }

    public function testCancelPayment()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteCancelarUnPagoApi::class,
            $paymentAPI->cancelPayment()
        );
    }

    public function testCreateReceiveCode()
    {
        $paymentAPI = new PaymentAPI();

        $this->assertInstanceOf(
            PermiteCrearUnRecieveCodeApi::class,
            $paymentAPI->createReceiveCode()
        );
    }
}

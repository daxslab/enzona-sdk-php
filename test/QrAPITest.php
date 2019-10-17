<?php

namespace daxslab\enzona\test;

use daxslab\enzona\BaseAPI;
use daxslab\enzona\qr\api\ObtieneLaInformacinDeUnQRApi;
use daxslab\enzona\qr\api\PermiteCrearUnQRDePagoAUnComercioApi;
use daxslab\enzona\qr\api\PermiteCrearUnQRParaHacerUnPagoEntrePersonas_Api;
use daxslab\enzona\QrAPI;

class QrAPITest extends \PHPUnit_Framework_TestCase
{

    public function test__canBeCreated()
    {
        $qrAPI = new QrAPI();
        $this->assertInstanceOf(
            BaseAPI::class,
            $qrAPI
        );
        $this->assertEquals(
            'https://api.enzona.net/qr/v1.0.0',
            $qrAPI->getConfig()->getHost()
        );

    }

    public function test__canBeCreatedAsSandbox()
    {
        $qrAPI = new QrAPI(true);

        $this->assertEquals(
            'https://apisandbox.enzona.net/qr/v1.0.0',
            $qrAPI->getConfig()->getHost()
        );
    }

    public function testCreateQrAccount()
    {
        $qrAPI = new QrAPI();

        $this->assertInstanceOf(
            PermiteCrearUnQRParaHacerUnPagoEntrePersonas_Api::class,
            $qrAPI->createQrAccount()
        );
    }

    public function testCreateQrMerchant()
    {
        $qrAPI = new QrAPI();

        $this->assertInstanceOf(
            PermiteCrearUnQRDePagoAUnComercioApi::class,
            $qrAPI->createQrMerchant()
        );
    }

    public function testQrInfo()
    {
        $qrAPI = new QrAPI();

        $this->assertInstanceOf(
            ObtieneLaInformacinDeUnQRApi::class,
            $qrAPI->qrCode()
        );
    }
}

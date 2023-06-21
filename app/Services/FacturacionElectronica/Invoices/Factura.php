<?php
namespace App\Services\FacturacionElectronica\Invoices;

use DateTime;
use App\Services\FacturacionElectronica\Core\Models\Sales\Invoice;
use App\Services\FacturacionElectronica\Core\Models\Sales\FormaPagos\FormaPagoContado;
use App\Services\FacturacionElectronica\Core\Models\Sales\FormaPagos\FormaPagoCredito;

class Factura
{
    public function __construct(
        public $venta,
        public $items
    )
    {
        //$this->create();
    }

    public static function create($venta, $items) :Invoice
    {
        $invoice = new Invoice();
        $invoice->setUblVersion('2.1')
            ->setTipoOperacion('0101')
            ->setTipoDoc($venta['tipo_comprobante_pago'])
            ->setSerie($venta['serie'])
            ->setCorrelativo($venta['numero'])
            ->setFechaEmision(new DateTime($venta['fecha_emision']." ".$venta['hora_emision']."-05:00"))
            ->setFormaPago( ($venta['forma_pago']) == 'contado' ? new FormaPagoContado() : new FormaPagoCredito())
            ->setTipoMoneda($venta['tipo_moneda'])
            ->setMtoOperGravadas(number_format($venta['total_gravada'],2))
            ->setMtoIGV($venta['total_igv'])
            ->setTotalImpuestos($venta['total_igv'])
            ->setValorVenta($venta['total_gravada'])
            ->setSubTotal(number_format($venta['total_gravada'] + $venta['total_igv'],2))
            ->setMtoImpVenta( number_format($venta['total_gravada'] + $venta['total_igv'],2))
        ;

        return $invoice;
    }

}

<?php
namespace App\Services\FacturacionElectronica\Invoices;

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

        return $invoice;
    }

}

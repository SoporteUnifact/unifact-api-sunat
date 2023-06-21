<?php

namespace App\Services\FacturacionElectronica\Invoices;

use App\Services\FacturacionElectronica\Core\Models\Sales\Invoice;

class Boleta
{
    public function __construct()
    {
        //$this->create();
    }

    public static function create($venta, $items): Invoice
    {
        return new Invoice();
    }
}

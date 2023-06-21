<?php

declare(strict_types=1);

namespace App\Services\FacturacionElectronica\Core\Models\Sales\FormaPagos;

use App\Services\FacturacionElectronica\Core\Models\Sales\PaymentTerms;

class FormaPagoContado extends PaymentTerms
{
    /**
     * FormaPagoContado constructor.
     */
    public function __construct()
    {
        $this->tipo = 'Contado';
        $this->moneda = null;
        $this->monto = null;
    }
}

<?php

declare(strict_types=1);

namespace App\Services\FacturacionElectronica\Core\Models\Sales\FormaPagos;

use App\Services\FacturacionElectronica\Core\Models\Sales\PaymentTerms;

class FormaPagoCredito extends PaymentTerms
{
    /**
     * FormaPagoCredito constructor.
     * @param float|null $monto
     * @param string|null $moneda
     */
    public function __construct(?float $monto = null, ?string $moneda = null)
    {
        $this->tipo = 'Credito';
        $this->monto = $monto;
        $this->moneda = $moneda;
    }
}

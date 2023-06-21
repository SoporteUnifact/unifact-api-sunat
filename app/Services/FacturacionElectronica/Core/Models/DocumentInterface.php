<?php

namespace App\Services\FacturacionElectronica\Core\Models;

/**
 * Interface DocumentInterface.
 */
interface DocumentInterface
{
    /**
     * Get Name for Document.
     *
     * @return string
     */
    public function getName(): string;
}

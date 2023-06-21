<?php
declare(strict_types=1);

namespace App\Services\FacturacionElectronica\Core\Models\Sales;

/**
 * Class Document.
 */
class Document
{
    /**
     * @var string
     */
    private $tipoDoc;

    /**
     * @var string
     */
    private $nroDoc;

    /**
     * @return string
     */
    public function getTipoDoc(): ?string
    {
        return $this->tipoDoc;
    }

    /**
     * @param string $tipoDoc
     *
     * @return Document
     */
    public function setTipoDoc(?string $tipoDoc): Document
    {
        $this->tipoDoc = $tipoDoc;

        return $this;
    }

    /**
     * @return string
     */
    public function getNroDoc(): ?string
    {
        return $this->nroDoc;
    }

    /**
     * @param string $nroDoc
     *
     * @return Document
     */
    public function setNroDoc(?string $nroDoc): Document
    {
        $this->nroDoc = $nroDoc;

        return $this;
    }
}

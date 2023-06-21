<?php
namespace App\Services\FacturacionElectronica\Core\Models\Customer;

use App\Services\FacturacionElectronica\Core\Models\Company\Address;

class Customer
{
    /**
     * @var string|null
     */
    private $tipoDoc;

    /**
     * @var string|null
     */
    private $numDoc;

    /**
     * @var string|null
     */
    private $rznSocial;

    /**
     * @var Address|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $telephone;

    /**
     * @return string|null
     */
    public function getTipoDoc(): ?string
    {
        return $this->tipoDoc;
    }

    /**
     * @param string|null $tipoDoc
     *
     * @return Customer
     */
    public function setTipoDoc(?string $tipoDoc): Customer
    {
        $this->tipoDoc = $tipoDoc;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumDoc(): ?string
    {
        return $this->numDoc;
    }

    /**
     * @param string|null $numDoc
     *
     * @return Customer
     */
    public function setNumDoc(?string $numDoc): Customer
    {
        $this->numDoc = $numDoc;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRznSocial(): ?string
    {
        return $this->rznSocial;
    }

    /**
     * @param string|null $rznSocial
     *
     * @return Customer
     */
    public function setRznSocial(?string $rznSocial): Customer
    {
        $this->rznSocial = $rznSocial;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address|null $address
     *
     * @return Customer
     */
    public function setAddress(?Address $address): Customer
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return Customer
     */
    public function setEmail(?string $email): Customer
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     *
     * @return Customer
     */
    public function setTelephone(?string $telephone): Customer
    {
        $this->telephone = $telephone;

        return $this;
    }
}

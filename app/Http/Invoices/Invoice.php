<?php
namespace App\Http\Invoices;
use App\Models\Customer;
use App\Models\Address;
class Invoice
{
    private Customer $customer;

    public function __construct(
        public $datos
    ){
        $this->setInterface();
    }

    public function setInterface()
    {
        $this->setCustomer();
    }

    public function setCustomer() :void
    {
        $cliente = $this->datos->cliente;

        $this->customer = new Customer();

        $this->customer->setTipoDoc($cliente['codigo_tipo_entidad'])
                ->setNumDoc($cliente['numero_documento'])
                ->setRznSocial($cliente['razon_social_nombres'])
                ->setAddress( (new Address())->setDireccion($cliente['cliente_direccion']))
        ;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}

<?php
namespace App\Services\FacturacionElectronica\Invoices;

use App\Services\FacturacionElectronica\Core\Models\Customer\Customer;
use App\Services\FacturacionElectronica\Core\Models\Company\Address;
use App\Services\FacturacionElectronica\Core\Models\Company\Company;
use App\Services\FacturacionElectronica\Core\Models\Sales\Invoice;
use App\Services\FacturacionElectronica\Core\Models\Sales\SaleDetail;
use App\Services\FacturacionElectronica\Invoices\Boleta;
use App\Services\FacturacionElectronica\Invoices\Factura;

class InvoiceDocument
{
    private Customer $customer;
    private Company $company;
    private Invoice $invoice;
    private SaleDetail $sale_detail;

    public function __construct(
        public $datos
    ){
        $this->setInterface();
    }

    public function setInterface() :void
    {
        $this->setCustomer();
        $this->setCompany();

        $this->invoice =  match($this->customer->getTipoDoc()){
                            '1','4' =>  $this->setBoletaInvoice(),
                            '6'   =>  $this->setFacturaInvoice()
                        }
        ;
    }
    public function setCustomer() :void
    {
        $cliente = $this->datos->cliente;

        $this->customer = new Customer();

        $this->customer->setTipoDoc($cliente['tipo_documento_identidad'])
                ->setNumDoc($cliente['numero_documento'])
                ->setRznSocial($cliente['razon_social_nombres'])
                ->setAddress( (new Address())->setDireccion($cliente['cliente_direccion']))
                ->setEmail($cliente['email'])
        ;
        if($cliente['tipo_documento_identidad']==6)
        {
            $this->customer->setTelephone($cliente['telefono']);
        }
    }

    public function getCustomer() :Customer
    {
        return $this->customer;
    }

    public function setCompany() :void
    {
        $company = $this->datos->empresa;

        $this->company = new Company();

        $this->company->setRuc($company['ruc'])
            ->setNombreComercial($company['nombre_comercial'])
            ->setRazonSocial($company['razon_social'])
            ->setAddress(
                (new Address())->setUbigueo($company['ubigeo'])
                ->setDistrito($company['distrito'])
                ->setProvincia($company['provincia'])
                ->setDepartamento($company['departamento'])
                ->setUrbanizacion($company['urbanizacion'])
                ->setCodLocal($company['codigo_local'])
                ->setDireccion($company['domicilio_fiscal'])
            )
            ->setEmail($company['email'])
            ->setTelephone($company['telefono'])
        ;
    }

    public function getCompany() :Company
    {
        return $this->company;
    }

    public function setBoletaInvoice() :Invoice
    {
        $venta = $this->datos->venta;
        $items = $this->datos->items;

        return Boleta::create($venta,$items);

    }

    public function setFacturaInvoice() :Invoice
    {
        $venta = $this->datos->venta;
        $items = $this->datos->items;

        return Factura::create($venta,$items);
    }
}

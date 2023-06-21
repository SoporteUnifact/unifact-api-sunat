<?php
namespace App\Services\FacturacionElectronica\Invoices;

use Luecano\NumeroALetras\NumeroALetras;
use App\Services\FacturacionElectronica\Core\Models\Customer\Customer;
use App\Services\FacturacionElectronica\Core\Models\Company\Address;
use App\Services\FacturacionElectronica\Core\Models\Company\Company;
use App\Services\FacturacionElectronica\Core\Models\Sales\Invoice;
use App\Services\FacturacionElectronica\Core\Models\Sales\Legend;
use App\Services\FacturacionElectronica\Core\Models\Sales\SaleDetail;
use App\Services\FacturacionElectronica\Invoices\Boleta;
use App\Services\FacturacionElectronica\Invoices\Factura;

class InvoiceDocument
{
    private Customer $customer;
    private Company $company;
    private Invoice $invoice;
    private array $sale_details;
    private Legend $legend;

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

        $this->invoice->setCustomer($this->customer)
                ->setCompany($this->company)
        ;

        $this->setSaleDetails();

        $this->setLegends();

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

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setSaleDetails() :void
    {
        $items = $this->datos->items;

        $catalogo = array();
        if(count($items) >0)
        {
            foreach($items as $item)
            {
                $detail = (new SaleDetail)
                    ->setCodProducto($item['codigo_producto'])
                    ->setCodProdSunat($item["codigo_sunat"])
                    ->setUnidad($item['codigo_unidad'])
                    ->setDescripcion($item['descripcion'])
                    ->setCantidad($item['cantidad'])
                    ->setMtoValorUnitario($item['valor_unitario'])
                    ->setMtoBaseIgv($item['monto_base_igv'])
                    ->setPorcentajeIgv($item['porcentaje_igv'])
                    ->setIgv($item['igv'])
                    ->setTipAfeIgv($item['tipo_afecto_igv'])
                    ->setTotalImpuestos($item['total_impuestos'])
                    ->setMtoPrecioUnitario($item['precio_unitario'])
                ;

                array_push($catalogo, $detail);
            }
        }

        $this->invoice->setDetails($catalogo);
    }

    public function setLegends() :void
    {
        $monto_letras = new NumeroALetras();
        $monto_letras = $monto_letras->toWords((float)round($this->invoice->getMtoImpVenta(),2),2);

        $numero = (float)(round($this->invoice->getMtoImpVenta(),2));
        $entero = intval($numero);
        $monto_decimal = str_pad(($numero-$entero)*100,2,"0",STR_PAD_LEFT);
        $letra_decimales = $monto_decimal."/100 ";

        $moneda = ($this->invoice->getTipoMoneda()== 'PEN') ? 'SOLES' :"SOLES";

        $this->legend = (new Legend)
            ->setCode($this->datos->venta['codigo_leyenda'])
            ->setValue("SON ".$monto_letras." Y ".$letra_decimales." ".$moneda)
        ;

        $this->invoice->setLegends([$this->legend]);
    }

    public function getLegend() :Legend
    {
        return $this->legend;
    }
}

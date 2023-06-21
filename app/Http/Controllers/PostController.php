<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacturacionElectronica\Invoices\InvoiceDocument;

class PostController extends Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("HTTP/1.1");
    }

    public function index(Request $request)
    {
        $invoice = new InvoiceDocument($request);
        return $invoice->getLegend()->getValue();
    }
}

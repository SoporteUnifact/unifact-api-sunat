<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Invoices\Invoice;

class PostController extends Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("HTTP/1.1");
    }

    public function index(Request $request)
    {
        $invoice = new Invoice($request);
        return $invoice->getCustomer()->getAddress()->getDireccion();
    }
}

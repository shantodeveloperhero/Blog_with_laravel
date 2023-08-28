<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function index(){
        $pdf = Pdf::loadView('pdf.invoice');
          return $pdf->download('invoice.pdf');
    }
}

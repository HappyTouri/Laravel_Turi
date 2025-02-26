<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;


class PdfController extends Controller
{
    public function invoicePDF()
    {

        $html = view('guestName')->render();
        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('document.pdf');
        // return view('guestName');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NotificationController extends Controller
{
    function printPDF($name, $view)
    {
        $pdf = Pdf::loadView('pdf.invoice');
        return $pdf->download($name + '.pdf');
    }

    function termsCondtions()
    {
        $this->printPDF('terms-and-conditions', 'terms-and-conditions');
    }
}

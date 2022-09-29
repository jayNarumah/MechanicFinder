<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;

class NotificationController extends Controller
{
    function printPDF($name, $view)
    {
        $pdf = Pdf::loadView($view);
        return $pdf->download($name);
    //     $pdf = PDF::loadView($view);
    //     $output = $pdf->output();

    // return response()->json($output, 200, [
    // 'Content-Type' => 'application/pdf',
    // 'Content-Disposition' =>  'inline; filename="' +$name+'"',
// ]);
    }

    function termsConditions()
    {
        $this->printPDF('terms-and-conditions.pdf', 'pdf.terms-and-conditions');
    }
}

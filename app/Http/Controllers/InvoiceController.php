<?php



namespace App\Http\Controllers;

use App\Models\Slip;
use App\Models\Barcode;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;



class InvoiceController extends Controller

{

    public function showPrintView($id)
    {

        $slip = Slip::with(['user', 'barcodes'])->findOrFail($id);

        $printbarcode = $slip->barcodes;

        return view('pass_slips.print_view', compact('slip', 'printbarcode'));
    }

    public function printPassSlip($id)
    {
        $slip = Slip::with('user')->findOrFail($id);
        $printbarcode = $slip->barcodes; // Adjust this to your actual fetching logic

        $pdf = FacadePdf::loadView('pass_slips.print_view', compact('slip', 'printbarcode')); // Passing $slip to the view

        return $pdf->stream('print_view.pdf');
    }

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index(Request $request)

    {

        $data = [

            [

                'quantity' => 2,

                'description' => 'Gold',

                'price' => '$500.00'

            ],

            [

                'quantity' => 3,

                'description' => 'Silver',

                'price' => '$300.00'

            ],

            [

                'quantity' => 5,

                'description' => 'Platinum',

                'price' => '$200.00'

            ]

        ];



        $pdf = Pdf::loadView('invoice', ['data' => $data]);



        return $pdf->download();
    }
}
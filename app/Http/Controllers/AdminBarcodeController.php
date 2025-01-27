<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;

class AdminBarcodeController extends Controller
{
    //
    public function viewbarcodelist()
    {
        $barcodes = Barcode::all();

        return view('admin.barcode.index', compact('barcodes'));
    }
}

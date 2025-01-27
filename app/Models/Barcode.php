<?php

namespace App\Models;

use App\Models\Slip;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    //
    protected $fillable = [
        'code',
        'date_scanned',
        'slip_id',
        'actual_time_departure',
        'actual_time_arrival',
        // other fields...
    ];

    public function slip()
    {
        return $this->belongsTo(Slip::class);
    }
}
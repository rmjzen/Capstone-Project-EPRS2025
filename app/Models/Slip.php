<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    use HasFactory;

    protected $fillable = [

        'time_departure',
        'time_arrival',
        'date_departure',
        'date_arrival',
        'purpose',
        'reason',
        'department',
        'head_office',
        'approved_by',
        'user_id',
        'status',
        'control_number', // Make sure this is included
    ];

    public function barcodes()
    {
        return $this->hasMany(Barcode::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

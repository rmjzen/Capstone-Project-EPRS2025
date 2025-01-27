<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation_name',
        'designation_desc',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
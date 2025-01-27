<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Slip;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'department',
        'designation',
        'head_type',
        'phone_number',
        'email',
        'password',
        'banned',
        'verification_code',
        'avatar',
        'head_type',
        'is_available',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function passSlips()
    {
        return $this->hasMany(Slip::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function isOnline()
    {
        return $this->last_seen && $this->last_seen->greaterThan(Carbon::now()->subSecond());
    }
}

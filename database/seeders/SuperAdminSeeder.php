<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'PIT Tabango Admin',
            'department' => 'Admin Department', // You can set this to a default value or generate dynamically
            'designation' => 'Admin', // Assuming you want a default designation
            'phone_number' => '09317317321', // You can set this to a default value or generate dynamically
            'email' =>  'pittabango2024@gmail.com',
            'password' => Hash::make('pittabango2024'),
            // 'password' => Hash::make('pitadmin'),
            'banned' => false, // Set banned to false
            'verification_code' => null, // Or generate a verification code if needed
            'is_verified' => true, // Set is_verified to true
        ]);
    }
}

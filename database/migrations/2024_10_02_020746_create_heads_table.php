<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('heads', function (Blueprint $table) {
            $table->id();
            $table->string('head_name');
            $table->string('department_head');
            $table->string('head_email');
            $table->string('head_password');
            $table->string('head_phone_number');
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heads');
    }
};

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
        Schema::create('slips', function (Blueprint $table) {
            $table->id();
            $table->string('control_number')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->time('time_departure');
            $table->time('time_arrival');
            $table->date('date_departure');
            $table->date('date_arrival');
            $table->string('purpose');
            $table->string('reason');
            $table->string('department');
            $table->string('head_office');
            $table->enum('status', ['cancel', 'pending', 'approved', 'disapproved'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slips');
    }
};
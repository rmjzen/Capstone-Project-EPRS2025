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
        Schema::table('slips', function (Blueprint $table) {
            //
            $table->timestamp('date_scanned')->nullable(); // Use nullable if you want to allow empty values
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slips', function (Blueprint $table) {
            //
        });
    }
};
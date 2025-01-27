<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            $table->time('actual_time_departure')->nullable();
            $table->time('actual_time_arrival')->nullable();
        });
    }

    public function down()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            $table->dropColumn(['actual_time_departure', 'actual_time_arrival']);
        });
    }
};

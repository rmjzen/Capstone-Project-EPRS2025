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
            // Add the slip_id foreign key column and allow NULL values
            $table->foreignId('slip_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            // Drop the foreign key and column if rolling back
            $table->dropForeign(['slip_id']);
            $table->dropColumn('slip_id');
        });
    }
};

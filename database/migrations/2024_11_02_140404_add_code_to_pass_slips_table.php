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
        Schema::table('slips', function (Blueprint $table) {
            $table->string('code')->nullable(); // Add the code column
        });
    }

    public function down()
    {
        Schema::table('slips', function (Blueprint $table) {
            $table->dropColumn('code'); // Remove the code column on rollback
        });
    }
};
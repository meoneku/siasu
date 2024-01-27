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
        Schema::table('ujianskripsi', function (Blueprint $table) {
            $table->string('va', 64)->nullable();
            $table->bigInteger('nominal');
            $table->string('status_pembayaran', 10)->default('BLM');
            $table->string('file_pembayaran', 255)->nullable();
            $table->string('file_brica_seminar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ujianskripsi', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seminar', function (Blueprint $table) {
            $table->string('va', 64)->nullable();
            $table->bigInteger('nominal');
            $table->string('status_pembayaran', 10)->default('BLM');
            $table->string('file_pembayaran', 255)->nullable();
            $table->string('file_krs')->nullable();
            $table->string('file_transkrip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seminar', function (Blueprint $table) {
            //
        });
    }
};

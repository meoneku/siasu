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
        Schema::create('lulusan_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lulusan_id');
            $table->unsignedBigInteger('jenis_berkas_id');
            $table->string('nomor', 255);
            $table->integer('tahun');
            $table->string('nama_kegiatan', 255);
            $table->string('file', 255);
            $table->timestamps();

            $table->foreign('lulusan_id')->references('id')->on('lulusan');
            $table->foreign('jenis_berkas_id')->references('id')->on('jenis_berkas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lulusan_berkas');
    }
};

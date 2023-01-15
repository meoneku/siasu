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
        Schema::create('skripsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->text('judul_skripsi');
            $table->string('lokasi_penelitian', 150);
            $table->string('nomor_handphone', 20);
            $table->string('email', 128);
            $table->integer('sks');
            $table->float('ipk');
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->date('awal_penugasan')->nullable();
            $table->date('akhir_penugasan')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');
            $table->foreign('dosen_id')->references('id')->on('dosen');
            $table->foreign('batch_id')->references('id')->on('batch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skripsi');
    }
};

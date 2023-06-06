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
        Schema::create('yudisium', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim')->unique();
            $table->string('nama', 128);
            $table->string('nik', 20);
            $table->unsignedInteger('jurusan_id');
            $table->unsignedInteger('batch_id');
            $table->string('tempat_lahir', 128);
            $table->date('tanggal_lahir');
            $table->string('gender', 10);
            $table->date('tanggal_ujian');
            $table->text('judul_skripsi');
            $table->string('nama_ayah', 64);
            $table->string('nama_ibu', 64);
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id')->on('jurusan');
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
        Schema::dropIfExists('yudisium');
    }
};

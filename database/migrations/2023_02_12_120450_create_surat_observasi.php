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
        Schema::create('surat_observasi', function (Blueprint $table) {
            $table->id();
            $table->string('lembaga', 200);
            $table->string('alamat', 200);
            $table->string('kecamatan', 128);
            $table->string('kabupaten', 128);
            $table->string('provinsi', 128);
            $table->unsignedBigInteger('mahasiswa_id');
            $table->text('judul_skripsi');
            $table->string('no_surat')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_observasi');
    }
};

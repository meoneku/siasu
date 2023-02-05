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
        Schema::create('suratpi', function (Blueprint $table) {
            $table->id();
            $table->string('tempat', 128);
            $table->unsignedBigInteger('jurusan_id');
            $table->string('alamat', 128);
            $table->string('kecamatan', 128);
            $table->string('kabupaten', 128);
            $table->string('provinsi', 128);
            $table->date('mulai_tanggal');
            $table->date('selesai_tanggal');
            $table->string('no_surat')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id')->on('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suratpi');
    }
};

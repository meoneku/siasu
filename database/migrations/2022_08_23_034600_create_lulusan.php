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
        Schema::create('lulusan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim')->unique();
            $table->string('nama', 128);
            $table->unsignedInteger('jurusan_id');
            $table->string('tempat_lahir', 128);
            $table->date('tanggal_lahir');
            $table->string('gender', 10);
            $table->date('tanggal_lulus');
            $table->date('tanggal_wisuda');
            $table->bigInteger('pin');
            $table->string('nomorijazah');
            $table->text('judul_skripsi');
            $table->string('foto', 255)->default('lulusan/default.png');
            $table->timestamps();

            $table->index(['nim']);
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
        Schema::dropIfExists('lulusan');
    }
};

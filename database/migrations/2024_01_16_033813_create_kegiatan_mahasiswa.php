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
        Schema::create('kegiatan_mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('kegiatan_id');
            $table->string('va', 150)->nullable();
            $table->string('status', 150)->default('AKT');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_kegiatan');
    }
};

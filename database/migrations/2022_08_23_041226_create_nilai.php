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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nim');
            $table->string('kd_mk', 10);
            $table->string('mata_kuliah', 255);
            $table->integer('mk_jenis');
            $table->integer('level');
            $table->integer('sks');
            $table->float('nilai');
            $table->integer('semester');
            $table->timestamps();

            $table->index(['nim']);
            $table->foreign('nim')->references('nim')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};

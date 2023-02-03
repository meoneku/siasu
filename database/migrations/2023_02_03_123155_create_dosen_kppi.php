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
        Schema::create('dosen_kppi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kppi_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('sebagai', 128);
            $table->smallInteger('ke');
            $table->timestamps();

            $table->foreign('kppi_id')->references('id')->on('kppi');
            $table->foreign('dosen_id')->references('id')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_kppi');
    }
};

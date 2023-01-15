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
        Schema::create('ujianskripsi_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujianskripsi_id');
            $table->unsignedBigInteger('dosen_id');
            $table->timestamps();

            $table->foreign('ujianskripsi_id')->references('id')->on('ujianskripsi');
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
        Schema::dropIfExists('ujianskripsi_dosen');
    }
};

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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 128);
            $table->string('penempatan', 128);
            $table->string('kondisi', 128);
            $table->string('no_inventaris', 128);
            $table->string('asal_barang', 128);
            $table->bigInteger('harga_barang')->default('0');
            $table->unsignedBigInteger('jenis_inventaris_id');
            $table->date('tanggal_pembelian')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('jenis_inventaris_id')->references('id')->on('jenis_inventaris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
};

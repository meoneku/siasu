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
        Schema::create('yudisium_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('yudisium_id');
            $table->string('jenis_berkas', 64);
            $table->string('bagian', 32)->nullable();
            $table->string('file', 128);
            $table->timestamps();

            $table->foreign('yudisium_id')->references('id')->on('yudisium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yudisium_berkas');
    }
};

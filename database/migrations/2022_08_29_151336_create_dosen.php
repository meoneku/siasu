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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('niy', 20)->unique();
            $table->integer('nidn');
            $table->string('nama', 200);
            $table->unsignedInteger('jurusan_id');
            $table->date('tmt');
            $table->string('jabatan', 100);
            $table->string('jafung', 30);
            $table->string('golongan', 4);
            $table->string('foto', 255)->default('dosen/default.png');
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
        Schema::dropIfExists('dosen');
    }
};

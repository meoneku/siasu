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
        Schema::create('ajar', function (Blueprint $table) {
            $table->id();
            $table->string('niy', 20);
            $table->integer('semester');
            $table->integer('sks')->default(0);
            $table->integer('kjm_pasca')->default(0);
            $table->integer('kjm_fai')->default(0);
            $table->integer('kjm_ft')->default(0);
            $table->integer('kjm_fti')->default(0);
            $table->integer('kjm_fe')->default(0);
            $table->integer('kjm_fip')->default(0);
            $table->integer('kjm_sore')->default(0);
            $table->integer('kjm_piba')->default(0);
            $table->timestamps();

            $table->foreign('niy')->references('niy')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajar');
    }
};

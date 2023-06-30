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
        Schema::create('kemahasiswaan', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 128);
            $table->string('nm_menu', 32);
            $table->string('slug', 150);
            $table->text('body');
            $table->timestamp('publish_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemahasiswaan');
    }
};

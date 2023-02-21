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
        Schema::create('materi_promosi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program')->nullable();
            $table->string('link')->nullable();
            $table->string('periode_rilis')->nullable();
            $table->string('tahun')->nullable();
            $table->string('berlaku_hingga')->nullable();
            $table->string('createdby')->nullable();
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
        Schema::dropIfExists('materi_promosi');
    }
};

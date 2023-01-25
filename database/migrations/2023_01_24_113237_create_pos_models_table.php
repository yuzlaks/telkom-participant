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
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->string('regional');
            $table->string('witel');
            $table->string('datel');
            $table->string('order_name');
            $table->string('order_email');
            $table->string('notel');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('tgl_order');
            $table->string('pos_id');
            $table->string('pos_name');
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
        Schema::dropIfExists('pos');
    }
};

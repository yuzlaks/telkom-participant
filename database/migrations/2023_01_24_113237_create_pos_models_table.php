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
            $table->integer('provinsi');
            $table->integer('kabupaten');
            $table->integer('kecamatan');
            $table->integer('kelurahan');
            $table->string('tgl_order');
            $table->string('pos_id');
            $table->string('pos_name');

            $table->string('status_fu');
            $table->string('status_offering')->nullable();
            // condition : [accept, pending, cancel]

            // if accept : manual input (PIC sesuai pos_id)
            // dan progress berubah jadi : PSB belum aktif
            $table->string('no_sc')->nullable();
            $table->string('progres')->nullable();
            
            // dan otomatis status berubah menjadi belum dibayar 
            // trigger btn bayar => akan berubah jadi sudah bayar
            // dan otomatis kolom progres berubah menjadi => PSB aktif
            $table->string('status_bayar')->nullable();

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

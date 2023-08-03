<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('dokter_id')->unsigned();
            $table->integer('spesialis_id')->unsigned();
            $table->integer('jadwal_id')->unsigned();
            $table->integer('nomor_antrian');
            $table->string('status');
            $table->date('tanggal');
            $table->string('tipe_pembayaran');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('spesialis_id')->references('id')->on('spesialis')->onDelete('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_dokter')->onDelete('cascade');
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
        Schema::dropIfExists('appointments');
    }
}

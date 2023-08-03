<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTelemedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_telemedicine', function (Blueprint $table) {
            $table->id();
            $table->integer('pasien_id')->unsigned();
            $table->unsignedBigInteger('jadwaltelemedicine_id')->unsigned();
            $table->integer('dokter_id')->unsigned();           
            $table->integer('spesialis_id')->unsigned();
            $table->time('jam_mulai');
            $table->time('jam_akhir');
            $table->integer('nomor_antrian');
            $table->date('tanggal');
            $table->double('nominal')->nullable();
            $table->string('status')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status_pengambilan_resep')->nullable();
            $table->string('jenis_pengambilan')->nullable();
            $table->string('alamat_pengambilan')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('resepobattelemedicine_id')->nullable();
            $table->timestamps();
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jadwaltelemedicine_id')->references('id')->on('jadwal_telemedicines')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');           
            $table->foreign('spesialis_id')->references('id')->on('spesialis')->onDelete('cascade');
            $table->foreign('resepobattelemedicine_id')->references('id')->on('resep_obats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_telemedicine');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string("kode");
          
            $table->integer('pasien_id')->unsigned();
            $table->integer('rekammedis_id')->unsigned();
            $table->date('tanggal_periksa');
            $table->date("tanggal_bayar");
            $table->double("jasa_dokter");
            $table->double("total");
            $table->double("bayar");
            $table->double("kembalian");
            // $table->string("nomor_antrian");
            $table->foreignId('resep_obat_id')->nullable()->constrained('resep_obats')->cascadeOnDelete();
            $table->foreignId('resep_obat_baru_id')->nullable()->constrained('resep_obats')->cascadeOnDelete();
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rekammedis_id')->references('id')->on('rekamedis')->onDelete('cascade');
            // $table->string('stasus');
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
        Schema::dropIfExists('transaksi');
    }
}

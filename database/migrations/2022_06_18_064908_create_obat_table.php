<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->increments('id');
            $table->string("kode");
            $table->integer('kategori_obat_id')->unsigned();
            $table->string("nama");
            $table->string("dosis");
            $table->string("satuan");
            $table->bigInteger("harga");
            $table->integer("stok");
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('lokasi')->nullable();
            $table->foreign('kategori_obat_id')->references('id')->on('kategori_obat')->onDelete('cascade');
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
        Schema::dropIfExists('obat');
    }
}

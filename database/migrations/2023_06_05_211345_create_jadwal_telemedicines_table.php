<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTelemedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_telemedicines', function (Blueprint $table) {
            $table->id();
            $table->integer('dokter_id')->unsigned();
            $table->integer('spesialis_id')->unsigned();
            $table->string("hari");
            $table->time("waktu_mulai");
            $table->time("waktu_selesai");
            $table->integer("stok");
            $table->double('nominal');
            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('spesialis_id')->references('id')->on('spesialis')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal_telemedicines');
    }
}

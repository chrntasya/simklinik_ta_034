<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekamedis', function (Blueprint $table) {
            $table->increments('id');
            $table->date("tanggal_pendaftaran");
            $table->string("diagnosa");
            $table->string("tindakan");
            $table->integer('pasien_id')->unsigned();
            $table->integer('dokter_id')->unsigned();
            $table->enum("suratketerangan", ['ya', 'tidak']);
            $table->foreignId('resep_obat_id')->nullable()->constrained('resep_obats')->cascadeOnDelete();
            $table->foreignId('resep_obat_baru_id')->nullable()->constrained('resep_obats')->cascadeOnDelete();
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('rekamedis');
    }
}

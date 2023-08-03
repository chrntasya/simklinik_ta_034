<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepObatDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_obat_details', function (Blueprint $table) {
            $table->id();
            // $table->string("keterangan_obat");
            $table->integer("jumlah_obat");
            $table->foreignId("id_obat");
            $table->foreignId("id_resep_obat")->nullable()->constrained('resep_obats')->cascadeOnDelete();
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
        Schema::dropIfExists('resep_obat_details');
    }
}

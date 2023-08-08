<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratoria', function (Blueprint $table) {
            $table->id();
            $table->integer('rujukan_id')->unsigned();
            $table->string('file')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('rujukan_id')->references('id')->on('rujukan')->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('laboratoria');
    }
}

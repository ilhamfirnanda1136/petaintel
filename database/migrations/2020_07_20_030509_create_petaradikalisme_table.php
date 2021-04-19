<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaradikalismeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petaradikalisme', function (Blueprint $table) {
            $table->id();
            $table->integer('satker_id');
            $table->integer('kecamatan_id');
            $table->string('bulan');
            $table->string('tahun');
            $table->integer('radikalisme_id');
            $table->string('judul');
            $table->text('keterangan');
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
        Schema::dropIfExists('petaradikalisme');
    }
}

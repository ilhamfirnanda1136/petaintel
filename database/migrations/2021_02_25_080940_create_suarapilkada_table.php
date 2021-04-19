<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuarapilkadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suarapilkada', function (Blueprint $table) {
            $table->id();
            $table->integer('paslon_id');
            $table->string('periode_pemilu');
            $table->string('kecamatan_id');
            $table->integer('jml_suara');
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
        Schema::dropIfExists('suarapilkada');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaksinasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaksinasi', function (Blueprint $table) {
            $table->id();
            $table->string('vaksinasi');
            $table->integer('kabupaten_id');
            $table->integer('kecamatan_id');
            $table->integer('satker_id');
            $table->string('tahun');
            $table->string('januari');
            $table->string('februari');
            $table->string('maret');
            $table->string('april');
            $table->string('mei');
            $table->string('juni');
            $table->string('juli');
            $table->string('agustus');
            $table->string('september');
            $table->string('oktober');
            $table->string('november');
            $table->string('desember');
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
        Schema::dropIfExists('vaksinasi');
    }
}

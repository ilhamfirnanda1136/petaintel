<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetalsmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petalsm', function (Blueprint $table) {
            $table->id();
            $table->integer('satker_id');
            $table->integer('kecamatan_id');
            $table->string('bulan');
            $table->string('tahun');
            $table->integer('lsm_id');
            $table->string('nama_lsm');
            $table->text('alamat');
            $table->string('no_skt');
            $table->date('tgl_skt');
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
        Schema::dropIfExists('petalsm');
    }
}

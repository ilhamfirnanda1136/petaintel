<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasanasingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengawasanasing', function (Blueprint $table) {
            $table->id();
            $table->integer('satker_id');
            $table->integer('kecamatan_id');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('nama');
            $table->string('kebangsaan');
            $table->string('kelamin');
            $table->string('maksud_tujuan');
            $table->text('alamat');
            $table->date('tgl_mulai');
            $table->string('lama');
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
        Schema::dropIfExists('pengawasanasing');
    }
}

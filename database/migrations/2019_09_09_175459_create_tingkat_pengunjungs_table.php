<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTingkatPengunjungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tingkat_pengunjung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('observasi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('tanggal');
            $table->double('pelajar');
            $table->double('umum');
            $table->double('dinas');
            $table->double('mancanegara');
            $table->double('total');
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
        Schema::dropIfExists('tingkat_pengunjung');
    }
}

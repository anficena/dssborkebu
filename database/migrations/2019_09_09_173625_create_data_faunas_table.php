<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataFaunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_fauna', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('observasi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('nama');
            $table->string('jenis');
            $table->integer('jumlah');
            $table->string('satuan');
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
        Schema::dropIfExists('data_fauna');
    }
}

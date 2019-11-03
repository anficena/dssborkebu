<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLayananKunjunganPemanfaatanKemitraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_kpk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('sub_layanan');
            $table->date('tanggal');
            $table->string('tamu');
            $table->string('instansi');
            $table->string('alamat');
            $table->string('keperluan');
            $table->string('lokasi');
            $table->string('jenis_layanan');
            $table->integer('jumlah');
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
        Schema::dropIfExists('layanan_kpk');
    }
}

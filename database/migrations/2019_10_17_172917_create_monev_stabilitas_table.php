<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonevStabilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monev_stabilitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('judul');
            $table->text('pengertian');
            $table->text('spesifikasi');
            $table->text('pedoman');
            $table->text('photo');
            $table->text('gambar_kerja');
            $table->text('referensi');
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
        Schema::dropIfExists('monev_stabilitas');
    }
}

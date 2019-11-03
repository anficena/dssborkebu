<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBakKontrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bak_kontrol', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('observasi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('waktu');
            $table->string('kategori');
            $table->string('parameter');
            $table->string('satuan');
            $table->string('lokasi');
            $table->string('hasil');
            $table->text('standar');
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
        Schema::dropIfExists('bak_kontrol');
    }
}

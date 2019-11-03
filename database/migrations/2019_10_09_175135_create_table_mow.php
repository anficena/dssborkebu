<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dokumentasi_id')->unsigned();
            $table->string('koleksi');
            $table->string('jumlah');
            $table->string('terkonservasi');
            $table->text('tindakan');
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
        Schema::dropIfExists('mow');
    }
}

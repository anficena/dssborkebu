<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemitraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemitraan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mitra');
            $table->string('koordinator');
            $table->string('perihal');
            $table->string('kategori');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->text('keterangan');
            $table->text('file');
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
        Schema::dropIfExists('kemitraan');
    }
}

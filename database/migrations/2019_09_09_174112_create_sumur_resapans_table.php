<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSumurResapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sumur_resapan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('observasi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('waktu');
            $table->string('lokasi');
            $table->string('kedalaman');
            $table->string('kondisi');
            $table->text('photo')->nullable();
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
        Schema::dropIfExists('sumur_resapan');
    }
}

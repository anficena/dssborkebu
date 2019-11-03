<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaterMatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_mater', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('observasi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('waktu');
            $table->string('lokasi');
            $table->string('wmk');
            $table->string('wmb');
            $table->text('keterangan');
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
        Schema::dropIfExists('water_mater');
    }
}

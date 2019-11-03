<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemiringanDindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemiringan_dinding', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('titik');
            $table->double('sumbu_xa');
            $table->double('sumbu_xb');
            $table->double('sumbu_xh');
            $table->double('sumbu_ya');
            $table->double('sumbu_yb');
            $table->double('sumbu_yh');
            $table->string('kemiringan_x');
            $table->string('kemiringan_y');
            $table->string('pedoman_x');
            $table->string('pedoman_y');
            $table->string('selisih_x');
            $table->string('selisih_y');
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
        Schema::dropIfExists('kemiringan_dinding');
    }
}

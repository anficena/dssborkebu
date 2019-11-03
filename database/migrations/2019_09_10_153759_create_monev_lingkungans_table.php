<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonevLingkungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monev_lingkungan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('judul');
            $table->text('tujuan');
            $table->text('sasaran');
            $table->text('target');
            $table->text('metode');
            $table->date('mulai');
            $table->date('selesai');
            $table->text('hasil');
            $table->text('file')->nullable();
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
        Schema::dropIfExists('monev_lingkungan');
    }
}

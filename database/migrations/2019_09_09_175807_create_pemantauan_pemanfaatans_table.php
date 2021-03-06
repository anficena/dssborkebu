<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemantauanPemanfaatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemantauan_pemanfaatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('keterangan');
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
        Schema::dropIfExists('pemantauan_pemanfaatan');
    }
}

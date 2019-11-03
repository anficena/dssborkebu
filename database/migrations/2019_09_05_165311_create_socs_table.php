<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('decision_id');
            $table->string('user_id');
            $table->date('tanggal');
            $table->string('decision');
            $table->string('kategori');
            $table->text('file');
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
        Schema::dropIfExists('socs');
    }
}

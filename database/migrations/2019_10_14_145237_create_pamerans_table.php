<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePameransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pameran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('tema');
            $table->string('tempat');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('pengunjung');
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
        Schema::dropIfExists('pameran');
    }
}

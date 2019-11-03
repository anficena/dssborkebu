<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteRerataObservasiIklim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observasi_iklim', function (Blueprint $table) {
            $table->dropColumn('rerata');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observasi_iklim', function (Blueprint $table) {
            $table->string('rerata');
        });
    }
}

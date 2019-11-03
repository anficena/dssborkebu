<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableKajian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kajian', function (Blueprint $table) {
            $table->renameColumn('keterangan', 'abstrak');
            $table->renameColumn('instansi', 'keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kajian', function (Blueprint $table) {
            $table->renameColumn('abstrak', 'keterangan');
            $table->renameColumn('keyword', 'instansi');
        });
    }
}

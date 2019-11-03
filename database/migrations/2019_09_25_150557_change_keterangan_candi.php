<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeKeteranganCandi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candi', function (Blueprint $table) {
            $table->renameColumn('keteragan', 'keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candi', function (Blueprint $table) {
            $table->renameColumn('keterangan', 'keteragan');
        });
    }
}

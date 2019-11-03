<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCandiIdTitikKontrol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titik_kontrol', function (Blueprint $table) {
            $table->renameColumn('candi_id', 'observasi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('titik_kontrol', function (Blueprint $table) {
            $table->renameColumn('observasi_id', 'candi_id');
        });
    }
}

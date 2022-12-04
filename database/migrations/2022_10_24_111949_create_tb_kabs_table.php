<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kabs', function (Blueprint $table) {
            $table->string('kode_kab')->primary();
            $table->string('kode_prov');
            $table->string('nama_kab');
            $table->foreign('kode_prov')->references('kode_prov')->on('tb_provs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kabs');
    }
};

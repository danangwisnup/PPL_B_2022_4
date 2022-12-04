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
        Schema::create('tb_dosens', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('nama');
            $table->string('email')->unique()->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_kab')->nullable();
            $table->string('kode_prov')->nullable();
            $table->string('handphone')->nullable();
            $table->string('status');
            $table->string('foto')->nullable();
            $table->foreign('nip')->references('nim_nip')->on('users')->onDelete('cascade');
            $table->foreign('kode_kab')->references('kode_kab')->on('tb_kabs');
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
        Schema::dropIfExists('tb_dosens');
    }
};

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
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('kode_kab')->nullable();
            $table->string('kode_prov')->nullable();
            $table->integer('angkatan');
            $table->string('jalur_masuk')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('handphone')->nullable();
            $table->string('kode_wali')->nullable();
            $table->string('status');
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_mahasiswa');
    }
};

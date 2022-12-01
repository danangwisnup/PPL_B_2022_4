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
        Schema::create('tb_mahasiswas', function (Blueprint $table) {
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
            $table->foreign('nim')->references('nim_nip')->on('users')->onDelete('cascade');
            $table->foreign('kode_kab')->references('kode_kab')->on('tb_kabs');
            $table->foreign('kode_prov')->references('kode_prov')->on('tb_provs');
            $table->foreign('kode_wali')->references('nip')->on('tb_dosens')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_mahasiswas');
    }
};

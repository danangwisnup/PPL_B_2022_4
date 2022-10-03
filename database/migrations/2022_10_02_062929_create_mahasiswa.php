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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('propinsi')->nullable();
            $table->integer('angkatan');
            $table->string('jalur_masuk');
            $table->string('email')->unique()->nullable();
            $table->string('handphone')->nullable();
            $table->string('dosen_wali')->nullable();
            $table->string('status')->nullable();
            $table->binary('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};

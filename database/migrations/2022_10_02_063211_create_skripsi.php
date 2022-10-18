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
        Schema::create('tb_skripsi', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->integer('semester_aktif');
            $table->string('nilai')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->integer('lama_studi')->nullable();
            $table->string('status');
            $table->binary('upload_skripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_skripsi');
    }
};

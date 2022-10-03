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
        Schema::create('skripsi', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nilai')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->integer('lama_studi')->nullable();
            $table->string('status_konfirmasi')->nullable();
            $table->binary('upload_skripsi')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skripsi');
    }
};

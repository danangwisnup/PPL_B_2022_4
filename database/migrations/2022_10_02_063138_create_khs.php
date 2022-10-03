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
        Schema::create('khs', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->integer('semester_aktif');
            $table->integer('sks');
            $table->integer('sks_kumulatif');
            $table->float('ip');
            $table->float('ip_kumulatif');
            $table->string('status_konfirmasi');
            $table->binary('upload_khs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khs');
    }
};

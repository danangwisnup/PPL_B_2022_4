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
        Schema::create('pkl', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nilai')->nullable();
            $table->integer('semester_aktif');
            $table->string('status_konfirmasi')->nullable();
            $table->binary('upload_pkl')->nullable();
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
        Schema::dropIfExists('pkl');
    }
};

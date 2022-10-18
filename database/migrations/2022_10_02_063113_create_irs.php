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
        Schema::create('tb_irs', function (Blueprint $table) {
            $table->integer('nim')->primary();
            $table->integer('semester_aktif');
            $table->integer('sks');
            $table->string('status');
            $table->binary('upload_irs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_irs');
    }
};

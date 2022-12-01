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
            $table->string('nim');
            $table->integer('semester_aktif');
            $table->integer('sks');
            $table->string('upload_irs');
            $table->unique(['nim', 'semester_aktif']);
            $table->foreign('nim')->references('nim')->on('tb_entry_progresses')->onDelete('cascade');
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

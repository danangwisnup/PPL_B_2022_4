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
        Schema::create('tb_pkl', function (Blueprint $table) {
            $table->string('nim');
            $table->integer('semester_aktif');
            $table->string('nilai')->nullable();
            $table->string('status');
            $table->string('upload_pkl')->nullable();
            $table->unique(['nim', 'semester_aktif']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pkl');
    }
};

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
        Schema::create('tb_entry_progresses', function (Blueprint $table) {
            $table->string('nim');
            $table->string('nip');
            $table->string('semester_aktif');
            $table->boolean('is_irs')->default(false);
            $table->boolean('is_khs')->default(false);
            $table->boolean('is_pkl')->default(false);
            $table->boolean('is_skripsi')->default(false);
            $table->boolean('is_verifikasi')->default(false);
            $table->timestamps();
            $table->unique(['nim', 'semester_aktif']);
            $table->foreign('nim')->references('nim')->on('tb_mahasiswas')->onDelete('cascade');
            $table->foreign('nip')->references('nip')->on('tb_dosens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_entry_progresses');
    }
};

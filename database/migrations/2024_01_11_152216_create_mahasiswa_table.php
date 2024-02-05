<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim',14)->primary();
            $table->string('nama',100);
            $table->string('no_wa',20)->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->enum('status', ['Baru','Nonaktif','Aktif','Lulus'])->default('Baru');
            $table->integer('id_dospem')->unsigned()->nullable();
            $table->string('periode_pkl',16)->nullable();

            $table->foreign('id_dospem')->references('id')->on('dosen_pembimbing')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

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
        Schema::create('cetak_sk', function (Blueprint $table) {
            $table->string('nim', 14)->primary();
            $table->enum('status', ['Belum','Sudah'])->default('Belum');
            $table->string('nama', 100);
            $table->string('judul');
            $table->int('id_dospem');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cetak_s_k_s');
    }
};

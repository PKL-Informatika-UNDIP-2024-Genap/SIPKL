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
        Schema::create('seminar_pkl', function (Blueprint $table) {
            $table->string('nim', 14)->primary();
            $table->enum('status', ['Diajukan','TakTerjadwal','Terjadwal']);
            $table->date('tgl_seminar');
            $table->string('pukul_seminar', 15);
            $table->string('ruang', 10);
            $table->string('nip', 25);
            $table->string('scan_layak_seminar')->nullable();
            $table->string('scan_peminjaman_ruang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminar_pkl');
    }
};

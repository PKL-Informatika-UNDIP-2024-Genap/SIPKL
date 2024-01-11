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
            $table->string('id', 15)->primary();
            $table->date('tanggal');
            $table->string('jam', 15);
            $table->string('ruang', 10);
            $table->string('id_pkl', 20);
            $table->string('nim', 14);
            $table->string('nip', 20);
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->string('scan_basp',100)->nullable();
            $table->string('scan_layak_seminar',100)->nullable();
            $table->string('scan_peminjaman_ruang',100)->nullable();
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

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
        Schema::create('arsip_pkl', function (Blueprint $table) {
            $table->string('nim',14)->primary();
            $table->string('nama',100);
            $table->string('periode_pkl',16)->nullable();
            $table->string('instansi',100);
            $table->string('judul');
            $table->text('abstrak')->nullable();
            $table->string('keyword1',50)->nullable();
            $table->string('keyword2',50)->nullable();
            $table->string('keyword3',50)->nullable();
            $table->string('keyword4',50)->nullable();
            $table->string('keyword5',50)->nullable();
            $table->string('link_berkas')->nullable();
            $table->dateTime('tgl_verif_laporan')->nullable();
            $table->decimal('nilai_angka',5,2)->nullable();
            $table->char('nilai',1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_pkl');
    }
};

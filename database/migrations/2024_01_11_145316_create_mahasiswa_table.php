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
            $table->string('status',30)->nullable();
            $table->string('nip_dospem',20)->nullable();
            $table->string('nama_dospem',100)->nullable();
            $table->string('periode_pkl',15)->nullable();
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

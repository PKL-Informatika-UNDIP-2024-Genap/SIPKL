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
        Schema::create('riwayat_pkl', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('periode',15);
            $table->string('status',10);
            $table->string('dospem',25);
            $table->char('nilai',1);
            $table->string('nim',14);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pkl');
    }
};

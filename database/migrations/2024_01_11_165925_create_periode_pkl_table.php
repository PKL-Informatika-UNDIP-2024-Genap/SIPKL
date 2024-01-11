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
        Schema::create('periode_pkl', function (Blueprint $table) {
            $table->string('id_periode', 15)->primary();
            $table->date('periode_mulai');
            $table->date('periode_berakhir');
            $table->string('status',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_pkl');
    }
};

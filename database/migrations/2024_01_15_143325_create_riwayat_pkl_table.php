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
            $table->string('nim',14);
            $table->string('periode',15);
            $table->string('status',10);
            $table->string('nip_dospem',25);
            $table->string('nama_dospem',100);
            $table->char('nilai',1);

            $table->primary(['nim', 'periode']);
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

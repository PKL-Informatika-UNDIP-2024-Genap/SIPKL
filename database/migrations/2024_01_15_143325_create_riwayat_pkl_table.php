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
            $table->string('periode_pkl',16);
            $table->enum('status',['Lulus','Tidak Lulus']);
            $table->integer('id_dospem')->unsigned();
            $table->char('nilai',1);

            $table->primary(['nim', 'periode_pkl']);
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

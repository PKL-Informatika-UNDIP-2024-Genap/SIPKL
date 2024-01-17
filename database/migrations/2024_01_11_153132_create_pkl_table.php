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
        Schema::create('pkl', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('instansi',100);
            $table->string('judul');
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->text('abstrak')->nullable();
            $table->string('keyword1',50)->nullable();
            $table->string('keyword2',50)->nullable();
            $table->string('keyword3',50)->nullable();
            $table->string('keyword4',50)->nullable();
            $table->string('keyword5',50)->nullable();
            $table->string('link_laporan')->nullable();
            $table->dateTime('tgl_laporan')->nullable();
            $table->string('pesan')->nullable();
            $table->char('nilai',1)->nullable();
            $table->string('nim',14);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkl');
    }
};

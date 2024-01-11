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
            $table->string('keywords1',50)->nullable();
            $table->string('keywords2',50)->nullable();
            $table->string('keywords3',50)->nullable();
            $table->string('keywords4',50)->nullable();
            $table->string('keywords5',50)->nullable();
            $table->char('nilai',1)->nullable();
            $table->string('nim',20);
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

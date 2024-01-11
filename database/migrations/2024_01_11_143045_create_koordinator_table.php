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
        Schema::create('koordinator', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('nip',20)->unique();
            $table->string('nama',100);
            $table->string('golongan',5)->nullable();
            $table->string('jabatan',30)->nullable();
            $table->string('email',100)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koordinator');
    }
};

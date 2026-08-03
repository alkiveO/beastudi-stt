<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('krs')) {
            Schema::create('krs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('mahasiswa_id');
                $table->unsignedBigInteger('matakuliah_id');
                $table->unsignedBigInteger('periode_id');
                $table->timestamps();

                $table->unique(['mahasiswa_id', 'matakuliah_id', 'periode_id'], 'krs_mahasiswa_matakuliah_periode_unique');
                $table->index('mahasiswa_id');
                $table->index('matakuliah_id');
                $table->index('periode_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
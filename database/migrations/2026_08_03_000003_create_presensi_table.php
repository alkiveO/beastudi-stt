<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('presensi')) {
            Schema::create('presensi', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('krs_id')->unique();
                $table->unsignedInteger('total_pertemuan')->default(0);
                $table->unsignedInteger('total_hadir')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
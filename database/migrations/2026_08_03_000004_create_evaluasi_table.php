<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('evaluasi')) {
            Schema::create('evaluasi', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('mahasiswa_id');
                $table->unsignedBigInteger('monitoring_id');
                $table->unsignedBigInteger('krs_id')->nullable();
                $table->string('jenis_sp');
                $table->text('keterangan')->nullable();
                $table->string('kontribusi')->nullable();
                $table->date('tanggal')->nullable();
                $table->timestamps();

                $table->index('mahasiswa_id');
                $table->index('monitoring_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluasi');
    }
};
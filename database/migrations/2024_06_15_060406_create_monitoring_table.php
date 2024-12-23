<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitoring', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->date('tanggal_isi');
            $table->integer('semester');
            $table->decimal('ipk', 3,2);
            $table->decimal('ips', 3,2);
            $table->integer('pembimbing_akademik_id');
            $table->integer('periode_id');
            $table->integer('kontribusi_khusus_id');
            $table->text('deskripsi_capaian')->nullable();
            $table->text('deskripsi_kendala')->nullable();
            $table->text('deskripsi_rencana')->nullable();
            $table->string('file_kegiatan')->nullable();
            $table->string('file_internal_kampus')->nullable();
            $table->string('file_prestasi')->nullable();
            $table->string('file_lpj')->nullable();
            $table->string('status_beastudi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('mhs_id');
            $table->string('nim')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('nama');
            $table->string('rombel')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_ktp_kepala_keluarga')->nullable();
            $table->string('nama_kepala_keluarga')->nullable();
            $table->string('tahun_masuk');
            $table->string('jenis_kelamin')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('program_studi');
            $table->string('jalur_beastudi')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('nomor_hp_ortu')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('alamat')->nullable();
            $table->boolean('status')->default(false); // status camaba
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

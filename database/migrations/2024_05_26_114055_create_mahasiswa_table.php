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
            $table->string('nim');
            $table->string('email');
            $table->string('nama');
            $table->string('no_kk');
            $table->string('no_ktp');
            $table->string('tahun_masuk');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->string('agama');
            $table->string('program_studi');
            $table->string('jalur_beastudi');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('nomor_hp');
            $table->string('nomor_hp_ortu');
            $table->string('kode_pos');
            $table->string('alamat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

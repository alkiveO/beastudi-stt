<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table
                ->string('no_kk')
                ->nullable()
                ->after('nama');
            $table
                ->string('no_ktp')
                ->nullable()
                ->after('no_kk');
            $table
                ->string('tahun_masuk')
                ->nullable()
                ->after('no_ktp');
            $table
                ->string('jenis_kelamin')
                ->nullable()
                ->after('tahun_masuk');
            $table
                ->string('tanggal_lahir')
                ->nullable()
                ->after('jenis_kelamin');
            $table
                ->string('agama')
                ->nullable()
                ->after('tanggal_lahir');
            $table
                ->string('program_studi')
                ->nullable()
                ->after('agama');
            $table
                ->string('jalur_beastudi')
                ->nullable()
                ->after('program_studi');
            $table
                ->string('provinsi')
                ->nullable()
                ->after('jalur_beastudi');
            $table
                ->string('kota')
                ->nullable()
                ->after('provinsi');
            $table
                ->string('kecamatan')
                ->nullable()
                ->after('kota');
            $table
                ->string('kelurahan')
                ->nullable()
                ->after('kecamatan');
            $table
                ->string('nomor_hp')
                ->nullable()
                ->after('kecamatan');
            $table
                ->string('nomor_hp_ortu')
                ->nullable()
                ->after('nomor_hp');
            $table
                ->string('kode_pos')
                ->nullable()
                ->after('nomor_hp_ortu');
            $table
                ->string('alamat')
                ->nullable()
                ->after('kode_pos');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('no_kk');
            $table->dropColumn('no_ktp');
            $table->dropColumn('tahun_masuk');
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('agama');
            $table->dropColumn('program_studi');
            $table->dropColumn('jalur_beastudi');
            $table->dropColumn('provinsi');
            $table->dropColumn('kota');
            $table->dropColumn('kecamatan');
            $table->dropColumn('kelurahan');
            $table->dropColumn('nomor_hp');
            $table->dropColumn('nomor_hp_ortu');
            $table->dropColumn('kode_pos');
            $table->dropColumn('alamat');
        });
    }
};

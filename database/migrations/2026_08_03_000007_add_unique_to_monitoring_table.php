<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus data duplikat (nim, semester, periode_id) yang sudah terlanjur ada,
        // simpan record dengan id terkecil. Ini mencegah penambahan unique index gagal.
        Schema::getConnection()->statement(
            'DELETE m1 FROM monitoring m1 INNER JOIN monitoring m2
             WHERE m1.id > m2.id
               AND m1.nim = m2.nim
               AND m1.semester = m2.semester
               AND m1.periode_id = m2.periode_id'
        );

        // Tambahkan unique index bila belum ada.
        if (! Schema::hasIndex('monitoring', 'monitoring_nim_semester_periode_id_unique')) {
            Schema::table('monitoring', function (Blueprint $table) {
                $table->unique(['nim', 'semester', 'periode_id'], 'monitoring_nim_semester_periode_id_unique');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasIndex('monitoring', 'monitoring_nim_semester_periode_id_unique')) {
            Schema::table('monitoring', function (Blueprint $table) {
                $table->dropUnique('monitoring_nim_semester_periode_id_unique');
            });
        }
    }
};
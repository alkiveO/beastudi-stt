<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom jenis_semester dipakai oleh kode namun belum ada di migration asli.
        if (! Schema::hasColumn('periode', 'jenis_semester')) {
            Schema::table('periode', function (Blueprint $table) {
                $table->string('jenis_semester')->nullable()->after('slug');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('periode', 'jenis_semester')) {
            Schema::table('periode', function (Blueprint $table) {
                $table->dropColumn('jenis_semester');
            });
        }
    }
};
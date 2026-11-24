<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreignId('pembimbing_akademik_id')
                ->nullable()
                ->constrained('pembimbing_akademik')
                ->nullOnDelete();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('pembimbing_akademik_id')
                ->nullable()
                ->constrained('pembimbing_akademik')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pembimbing_akademik_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pembimbing_akademik_id');
        });
    }
};
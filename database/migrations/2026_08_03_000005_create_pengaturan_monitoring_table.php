<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pengaturan_monitoring')) {
            Schema::create('pengaturan_monitoring', function (Blueprint $table) {
                $table->id();
                $table->boolean('is_active')->default(false);
                $table->timestamp('tanggal_buka')->nullable();
                $table->timestamp('tanggal_tutup')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_monitoring');
    }
};
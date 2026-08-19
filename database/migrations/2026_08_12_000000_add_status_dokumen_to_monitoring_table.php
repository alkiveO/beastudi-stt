<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('monitoring', function (Blueprint $table) {
            $table->string('status_file_spb')->nullable()->after('file_spb');
            $table->text('keterangan_file_spb')->nullable()->after('status_file_spb');
            $table->string('status_file_lpj')->nullable()->after('file_lpj');
            $table->text('keterangan_file_lpj')->nullable()->after('status_file_lpj');
        });
    }

    public function down(): void
    {
        Schema::table('monitoring', function (Blueprint $table) {
            $table->dropColumn([
                'status_file_spb',
                'keterangan_file_spb',
                'status_file_lpj',
                'keterangan_file_lpj',
            ]);
        });
    }
};

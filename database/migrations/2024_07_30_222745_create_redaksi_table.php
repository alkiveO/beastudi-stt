<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('redaksi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('slug');
            $table->string('judul');
            $table->text('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redaksi');
    }
};

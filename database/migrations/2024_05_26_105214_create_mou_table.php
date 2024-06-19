<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mou', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('mahasiswa');
            $table->integer('program_studi_id');
            $table->string('angkatan');
            $table->string('file');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mou');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mou', function (Blueprint $table) { // mou camaba
            $table->id();
            $table->string('mahasiswa_id');
            $table->string('spb_rangkap_1');
            $table->string('spb_rangkap_2');
            $table->string('surat_komitmen_ortu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mou');
    }
};

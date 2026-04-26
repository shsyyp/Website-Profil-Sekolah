<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Menggunakan nama tabel 'pmb'
        Schema::create('pmb', function (Blueprint $table) {
            $table->id();
            $table->text('alur')->nullable(); // Bisa diisi teks HTML atau JSON
            $table->text('persyaratan_umum')->nullable();
            $table->text('berkas')->nullable();
            $table->text('jadwal')->nullable(); // Bisa diisi teks HTML atau JSON
            $table->text('faq')->nullable(); // Bisa diisi teks HTML atau JSON
            $table->string('link_pendaftaran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pmb');
    }
};
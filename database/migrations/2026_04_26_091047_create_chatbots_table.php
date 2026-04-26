<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatbots', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('pertanyaan');
            $table->text('jawaban');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbots');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->integer('pessoa_id');
            $table->integer('pergunta_id');
            $table->integer('questionario_id');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};

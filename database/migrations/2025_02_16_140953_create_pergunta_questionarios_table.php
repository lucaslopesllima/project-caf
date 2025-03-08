<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pergunta_questionarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionario_id')->constrained()->onDelete('cascade');
            $table->foreignId('pergunta_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['questionario_id', 'pergunta_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pergunta_questionarios');
    }
};

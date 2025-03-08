<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('idade');
            $table->integer('quantidade_filhos');
            $table->string('naturalidade');
            $table->string('bairro');
            $table->string('escolaridade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};

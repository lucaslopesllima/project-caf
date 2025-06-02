<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_started');
            $table->date('date_finished')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('responsible_id');
            $table->string('responsible_type');
            $table->boolean('is_activated')->default(true);
            $table->timestamps();
        });

        Schema::create('person_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id'); 
            $table->unsignedBigInteger('project_id');
            $table->boolean('is_volunteer')->default(false);
            $table->timestamps();
            
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade'); 
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('person_project');
        Schema::dropIfExists('projects');
    }
};
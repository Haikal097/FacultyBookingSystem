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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., DK 200, DK 100 A & B
            $table->string('type'); // e.g., Dewan Kuliah, Bilik Seminar
            $table->integer('capacity')->nullable(); // e.g., 200
            $table->text('package')->nullable(); // e.g., Projector, White Board
            $table->string('location')->nullable(); // optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

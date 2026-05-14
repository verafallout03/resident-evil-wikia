<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('release_year');
            $table->string('platform');           // PS1, PS4, PC, etc.
            $table->string('developer')->default('Capcom');
            $table->text('cover_image')->nullable();
            $table->text('synopsis')->nullable();
            $table->enum('canon', ['main', 'spin-off', 'remake'])->default('main');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

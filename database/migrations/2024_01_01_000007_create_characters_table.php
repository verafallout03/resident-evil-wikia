<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('alias')->nullable();        // "The Merchant", "Lady D", etc.
            $table->enum('faction', [
                'S.T.A.R.S.',
                'B.S.A.A.',
                'Umbrella',
                'Neo-Umbrella',
                'The Connections',
                'Independent',
                'Villain',
                'Infected',
                'Unknown',
            ])->default('Unknown');
            $table->enum('status', ['alive', 'deceased', 'unknown', 'mutated'])
                  ->default('unknown');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('nationality')->nullable();
            $table->string('blood_type')->nullable();
            $table->integer('height_cm')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('is_playable')->default(false);
            $table->boolean('is_published')->default(true);
            $table->text('lore')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};

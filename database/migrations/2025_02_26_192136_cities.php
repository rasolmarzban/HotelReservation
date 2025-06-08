<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create the cities table
        Schema::create('cities', function (Blueprint $table) {
            $table->id();  // Primary key for the city
            $table->string('name')->unique();  // City name, should be unique
            $table->foreignId('province_id') // Foreign key to the provinces table
                ->constrained('provinces')  // It references the provinces table
                ->onDelete('cascade');  // If a province is deleted, its cities will also be deleted
            $table->timestamps();  // Created at, updated at
        });
    }

    public function down(): void
    {
        // Drop the cities table if rolling back the migration
        Schema::dropIfExists('cities');
    }
};

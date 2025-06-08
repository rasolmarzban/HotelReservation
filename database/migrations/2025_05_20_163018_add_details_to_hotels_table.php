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
        Schema::table('hotels', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->integer('number_of_bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // in square meters
            $table->integer('capacity')->nullable();
            $table->decimal('price_per_night', 10, 2)->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_jacuzzi')->default(false);
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->string('owner_name')->nullable();
            $table->string('owner_phone')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'number_of_rooms',
                'number_of_bathrooms',
                'area',
                'capacity',
                'price_per_night',
                'rating',
                'has_pool',
                'has_jacuzzi',
                'has_wifi',
                'has_parking',
                'owner_name',
                'owner_phone',
                'owner_email',
                'address'
            ]);
        });
    }
};

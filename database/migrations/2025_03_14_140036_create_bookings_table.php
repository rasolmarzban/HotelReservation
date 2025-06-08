<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade'); // Foreign key to the hotels table
            $table->foreignId('room_id')->constrained()->onDelete('cascade');   // Foreign key to the rooms table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // Foreign key to the users table
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('number_of_guests');
            $table->decimal('cost_per_night', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->string('booking_reference')->unique();
            $table->string('payment_status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};

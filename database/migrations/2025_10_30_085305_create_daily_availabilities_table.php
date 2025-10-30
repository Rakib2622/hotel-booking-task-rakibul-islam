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
    Schema::create('daily_availabilities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('room_category_id')->constrained()->onDelete('cascade');
        $table->date('date');
        $table->integer('booked_rooms')->default(0); // out of 3
        $table->timestamps();

        $table->unique(['room_category_id', 'date']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_availabilities');
    }
};

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
        Schema::create('course_fee_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('fee_structure_locations')->onDelete('cascade');
            $table->foreignId('duration_id')->constrained('fee_structure_durations')->onDelete('cascade');
            $table->decimal('course_fee', 10, 2);
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->integer('serial_number')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            
            // Ensure unique combination of course, location, and duration
            $table->unique(['course_id', 'location_id', 'duration_id'], 'unique_course_location_duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_fee_structures');
    }
};

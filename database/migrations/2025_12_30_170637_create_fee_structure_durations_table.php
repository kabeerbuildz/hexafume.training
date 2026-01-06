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
        Schema::create('fee_structure_durations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "1 months", "1.5 months"
            $table->decimal('value', 5, 2); // e.g., 1.00, 1.50, 2.00
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structure_durations');
    }
};

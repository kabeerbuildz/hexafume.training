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
        Schema::create('fee_structure_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag')->nullable(); // e.g., "ON-CAMPUS", "INTERNATIONAL DESK"
            $table->text('address');
            $table->string('icon_color')->nullable(); // blue, green, red, orange, purple, pink, grey
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->string('link')->nullable(); // Branch page URL
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
        Schema::dropIfExists('fee_structure_branches');
    }
};
